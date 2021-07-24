<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\ProdukTransaksi;
use App\Models\Rekening;
use App\Models\Wisata;
use App\Models\WisataTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Laravolt\Indonesia\Models\Province;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TransaksiController extends Controller
{
    public function beli_tiket($id)
    {
        $item = Wisata::findOrFail($id);

        if ($item->status == 0) {
            return view('pages.user.beli-tiket', [
                'item' => $item
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function sewa($id)
    {
        $item = Wisata::findOrFail($id);

        if ($item->status == 0) {
            return view('pages.user.beli-tiket-2', [
                'item' => $item
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function beli_produk($id)
    {
        $item = Produk::findOrFail($id);
        $provinces = Province::pluck('name', 'id');

        if ($item->status == 0) {
            return view('pages.user.beli-produk', [
                'item' => $item, 'provinces' => $provinces
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function bayar_tiket(Request $request)
    {
        $jumlah_orang = $request->jumlah_orang;
        $total = $request->total;
        $tanggal = $request->tanggal;

        $check = Wisata::where('id', $request->wisata_id)->first();

        $hari = strtolower(Carbon::parse($tanggal)->translatedFormat('l'));

        $status = explode ("|", $check->hari_buka);

        if ($check->status == 0) {
            if (in_array($hari, $status)) {
                $item = new WisataTransaksi();
                $item->wisata_id = $request->wisata_id;
                $item->user_id = Auth::user()->id;
                $item->jumlah_orang = $jumlah_orang;
                $item->total_bayar = $total;
                $item->tanggal_tiket = $tanggal;
                $item->save();

                return redirect()->route('transaksi')->with('bayar-tiket', 'Bayar Tiket');
            }else {
                return redirect()->back()->withInput();
            }
        } else {
            return redirect()->back();
        }
    }

    public function bayar_sewa(Request $request)
    {
        $jam = $request->jam;
        $tanggal = $request->tanggal;
        $total = $request->total;
        $id = $request->wisata_id;

        $checkWisata = Wisata::where('id', $request->wisata_id)->first();

        if ($checkWisata->status == 0) {
            $check = Wisata::findOrFail($request->wisata_id);
            $check2 = WisataTransaksi::where('wisata_id', $id)->where('tanggal_sewa', $tanggal)->first();
            $count = WisataTransaksi::where('wisata_id', $id)->where('tanggal_sewa', $tanggal)->count();

            if ($check->stok != NULL) {
                if ($check->stok >= 1 && $count < $check->stok) {
                    $item = new WisataTransaksi();
                    $item->wisata_id = $request->wisata_id;
                    $item->user_id = Auth::user()->id;
                    $item->jam_sewa = $jam;
                    $item->total_bayar = $total;
                    $item->tanggal_sewa = $tanggal;
                    $item->save();

                    return redirect()->route('transaksi')->with('bayar-sewa', 'Bayar Sewa');
                }else {
                    return redirect()->back();
                }
            } else {
                if ($check2 == null) {
                    $item = new WisataTransaksi();
                    $item->wisata_id = $request->wisata_id;
                    $item->user_id = Auth::user()->id;
                    $item->jam_sewa = $jam;
                    $item->total_bayar = $total;
                    $item->tanggal_sewa = $tanggal;
                    $item->save();

                    return redirect()->route('transaksi')->with('bayar-sewa', 'Bayar Sewa');
                }else {
                    return redirect()->back();
                }
            }
        } else {
            return redirect()->back();
        }
    }

    public function bayar_tiket_show($id)
    {
        $item = WisataTransaksi::findOrFail($id);
        $rekening = Rekening::all();

        return view('pages.user.beli-tiket-proses', [
            'item' => $item, 'rekenings' => $rekening
        ]);
    }

    public function batal_tiket($id)
    {
        $item = WisataTransaksi::findOrFail($id);
        $item->delete();

        return redirect()->route('transaksi')->with('batal-tiket', 'Batal Tiket');
    }

    public function proses_tiket(Request $request, $id)
    {
        $value = $request->file('bukti_bayar');
        $extension = $value->extension();
        $imageNames = uniqid('img_', microtime()) . '.' . $extension;
        Storage::putFileAs('public/images/bukti-bayar-tiket', $value, $imageNames);
        $thumbnailpath = public_path('storage/images/bukti-bayar-tiket/' . $imageNames);
        $img = Image::make($thumbnailpath)->resize(600, 400)->save($thumbnailpath);

        $item = WisataTransaksi::findOrFail($id);
        $item->nomor_rekening = $request->no_rekening;
        $item->rekening = $request->rekening;
        $item->bukti_bayar = $imageNames;
        $item->status_bayar = 'menunggu-konfirmasi';
        $item->save();

        return redirect()->route('transaksi')->with('tunggu-konfirmasi', 'Tunggu Konfirmasi');
    }

    public function konfirmasi_produk(Request $request)
    {
        $produk = Produk::findOrFail($request->produk_id);

        if ($produk->status == 0) {
            if ($request->quantitas > $produk->stok) {
                return redirect()->back()->withInput();
            } else {
                $stok = $produk->stok;
                $produk->stok = $stok - $request->quantitas;
                $produk->save();

                $item = new ProdukTransaksi();
                $item->user_id = Auth::user()->id;
                $item->produk_id = $request->produk_id;
                $item->quantitas = $request->quantitas;
                $item->total_harga = $request->total_harga;
                $item->total_berat = $request->total_berat;
                $item->status_bayar = 'belum-bayar';
                $item->provinsi_id = $request->provinsi_id;
                $item->kota_id = $request->kota_id;
                $item->kecamatan_id = $request->kecamatan_id;
                $item->kelurahan_id = $request->kelurahan_id;
                $item->alamat_lengkap = $request->alamat_lengkap;
                $item->kode_pos = $request->kode_pos;
                $item->save();

                return redirect()->route('transaksi')->with('bayar-produk', 'Bayar Produk');
            }
        } else {
            return redirect()->back();
        }
    }

    public function bayar_produk_show($id)
    {
        $item = ProdukTransaksi::findOrFail($id);
        $rekening = Rekening::all();

        return view('pages.user.beli-produk-proses', [
            'item' => $item, 'rekenings' => $rekening
        ]);
    }

    public function proses_pembayaran_produk(Request $request, $id)
    {
        $value = $request->file('bukti_bayar');
        $extension = $value->extension();
        $imageNames = uniqid('img_', microtime()) . '.' . $extension;
        Storage::putFileAs('public/images/bukti-bayar-produk', $value, $imageNames);
        $thumbnailpath = public_path('storage/images/bukti-bayar-produk/' . $imageNames);
        $img = Image::make($thumbnailpath)->resize(600, 400)->save($thumbnailpath);

        $item = ProdukTransaksi::findOrFail($id);
        $item->nomor_rekening = $request->no_rekening;
        $item->rekening = $request->rekening;
        $item->bukti_bayar = $imageNames;
        $item->status_bayar = 'menunggu-konfirmasi';
        $item->save();

        return redirect()->route('transaksi')->with('tunggu-konfirmasi', 'Tunggu Konfirmasi');
    }

    public function bayar_ongkos_kirim($id)
    {
        $item = ProdukTransaksi::findOrFail($id);
        $rekening = Rekening::all();

        return view('pages.user.beli-produk-proses-2', [
            'item' => $item, 'rekenings' => $rekening
        ]);
    }

    public function proses_ongkos_kirim(Request $request, $id)
    {
        $value = $request->file('bukti_bayar');
        $extension = $value->extension();
        $imageNames = uniqid('img_', microtime()) . '.' . $extension;
        Storage::putFileAs('public/images/bukti-bayar-ongkos-kirim', $value, $imageNames);
        $thumbnailpath = public_path('storage/images/bukti-bayar-ongkos-kirim/' . $imageNames);
        $img = Image::make($thumbnailpath)->resize(600, 400)->save($thumbnailpath);

        $item = ProdukTransaksi::findOrFail($id);
        $item->nomor_rekening_2 = $request->no_rekening;
        $item->rekening_2 = $request->rekening;
        $item->bukti_bayar_2 = $imageNames;
        $item->status_pengiriman = 'sudah-bayar-ongkir';
        $item->save();

        return redirect()->route('transaksi')->with('tunggu-konfirmasi', 'Tunggu Konfirmasi');
    }

    public function delete_produk($id)
    {
        $item = ProdukTransaksi::findOrFail($id);
        $id_produk = $item->produk_id;
        $filename  = ('public/images/bukti-bayar-produk/').$item->bukti_bayar;
        $filename2  = ('public/images/bukti-bayar-ongkos-kirim/').$item->bukti_bayar_2;
        Storage::delete($filename);
        Storage::delete($filename2);
        $produk = Produk::findOrFail($id_produk);
        $produk->stok = $produk->stok + $item->quantitas;
        $produk->save();
        $item->delete();

        return redirect()->route('transaksi')->with('hapus-produk', 'hapus Produk');
    }

    public function pdf_tiket($id)
    {
        $item = WisataTransaksi::findOrFail($id);

        $pdf = PDF::loadview('pages.pdf.tiket', [
            'item' => $item
        ])->setPaper('a6', 'portrait');
        if ($item->user->roles == 'ADMIN') {
            $nama = 'Admin';
        }elseif ($item->user->roles == 'USER') {
            $nama = $item->user->name;
        }
        return $pdf->stream('E-Ticket ' . $item->id . ' - ' . $item->wisata->nama_wisata . ' - ' . $nama . '.pdf');
    }

    public function pdf_sewa($id)
    {
        $item = WisataTransaksi::findOrFail($id);

        $pdf = PDF::loadview('pages.pdf.sewa', [
            'item' => $item
        ])->setPaper('a6', 'portrait');
        if ($item->user->roles == 'ADMIN') {
            $nama = 'Admin';
        }elseif ($item->user->roles == 'USER') {
            $nama = $item->user->name;
        }
        return $pdf->stream('E-Ticket ' . $item->id . ' - ' . $item->wisata->nama_wisata . ' - ' . $nama . '.pdf');
    }

    public function pdf_invoice($id)
    {
        $item = ProdukTransaksi::findOrFail($id);

        $pdf = PDF::loadview('pages.pdf.produk', [
            'item' => $item
        ]);
        if ($item->user->roles == 'ADMIN') {
            $nama = 'Admin';
        }elseif ($item->user->roles == 'USER') {
            $nama = $item->user->name;
        }
        return $pdf->stream('E-Ticket ' . $item->id . ' - ' . $item->produk->nama_produk . ' - ' . $nama . '.pdf');
    }

}
