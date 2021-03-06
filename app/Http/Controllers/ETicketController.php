<?php

namespace App\Http\Controllers;

use App\Models\ProdukTransaksi;
use App\Models\User;
use App\Models\Wisata;
use App\Models\WisataTransaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class ETicketController extends Controller
{
    public function index()
    {
        $items = WisataTransaksi::orderBy('id', 'DESC')->get();
        return view('pages.admin.e-ticket.index', [
            'items' => $items
        ]);
    }

    public function lihat_bukti_bayar($id)
    {
        $item = WisataTransaksi::findOrFail($id);

        return view('pages.admin.e-ticket.bukti-bayar', [
            'item' => $item
        ]);
    }

    public function konfirmasi_bayar($id)
    {
        $item = WisataTransaksi::findOrFail($id);

        $user_id = Auth::user()->id;

        $tgl = $item->tanggal_tiket;
        $tgl2 = Str::remove('-', $tgl);
        $text = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 6);

        $qr_code = "TC-" . $id . $user_id . $tgl2 . $item->jumlah_orang . $text;

        $item->status_bayar = 'sudah-bayar';
        $item->qr_code = $qr_code;
        $item->save();

        return redirect()->route('e-ticket.index')->with('success-konfirmasi', 'Sukses');
    }

    public function batal_pembayaran($id)
    {
        $item = WisataTransaksi::findOrFail($id);
        $item->status_bayar = 'belum-bayar';
        $filename = ('public/images/bukti-bayar-tiket/').$item->bukti_bayar;
        Storage::delete($filename);
        $item->bukti_bayar = NULL;
        $item->save();

        return redirect()->route('e-ticket.index')->with('batal-pembayaran', 'Sukses');
    }

    public function batal_tiket($id)
    {
        $item = WisataTransaksi::findOrFail($id);
        $filename  = ('public/images/bukti-bayar-tiket/').$item->bukti_bayar;
        Storage::delete($filename);
        $item->delete();

        return redirect()->route('e-ticket.index')->with('batal-tiket', 'Sukses');
    }

    public function tambahData()
    {
        $wisata = Wisata::where('status', 0)->get();
        return view('pages.admin.e-ticket.create', [
            'wisatas' => $wisata
        ]);
    }

    public function storeData(Request $request)
    {
        $item = new WisataTransaksi();
        $item->wisata_id = $request->wisata_id;
        $item->user_id = Auth::user()->id;

        $wisata = Wisata::findOrFail($request->wisata_id);
        if ($wisata->kategori == 'wisata' || $wisata->kategori == 'tubing') {
            $item->jumlah_orang = $request->jumlah_orang;
            $item->tanggal_tiket = $request->tanggal_tiket;
        }elseif ($wisata->kategori == 'camping' || $wisata->kategori == 'glamping') {
            $item->jam_sewa = $request->jam_sewa;
            $item->tanggal_sewa = $request->tanggal_sewa;
        }
        $item->total_bayar = $request->total_bayar;
        $item->status_bayar = 'sudah-bayar';
        $item->save();

        $user_id = Auth::user()->id;

        $tgl = $item->tanggal_tiket;
        $tgl2 = Str::remove('-', $tgl);
        $text = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 6);

        $qr_code = "TC-" . $item->id . $user_id . $tgl2 . $item->jumlah_orang . $text;
        $item->qr_code = $qr_code;
        $item->save();

        return redirect()->route('e-ticket.index')->with('success-tambah', 'Sukses');
    }

    public function printTiket($id)
    {
        $item = WisataTransaksi::findOrFail($id);

        return view('pages.pdf.print', [
            'item' => $item
        ]);
    }

    public function printInvoice($id)
    {
        $item = ProdukTransaksi::findOrFail($id);

        return view('pages.pdf.print-2', [
            'item' => $item
        ]);
    }
}
