<?php

namespace App\Http\Controllers;

use App\Models\Kamus;
use App\Models\Wisata;
use App\Models\WisataTransaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function total_harga_tiket(Request $request)
    {
        $jumlah_orang = $request->jumlah_orang;
        $harga = $request->harga;

        $total = rupiah($jumlah_orang * $harga);
        $total2 = $jumlah_orang * $harga;

        return response()->json(['harga' => $total, 'total' => $total2]);
    }

    public function cek_sewa(Request $request, $id)
    {
        $jam = $request->jam;
        $tanggal = $request->tanggal;

        $check = WisataTransaksi::where('wisata_id', $id)->where('tanggal_sewa', $tanggal)->where('jam_sewa', $jam)->first();

        if ($check == null) {
            return response()->json(['pesan'=>'Bisa Dibooking']);
        }else {
            return response()->json(['pesan'=>'Mohon Maaf.. Sudah Tidak Bisa Dibooking']);
        }
    }

    public function cek_hari(Request $request)
    {
        $check = Wisata::where('id', $request->wisata_id)->first();

        $tanggal = $request->tanggal;
        $hari = strtolower(Carbon::parse($tanggal)->translatedFormat('l'));

        $status = explode ("|", $check->hari_buka);

        if (in_array($hari, $status)) {
            return response()->json(['pesan'=>'']);
        }else {
            return response()->json(['pesan'=>'Mohon maaf.. tempat tersebut tutup']);
        }

    }

    public function cek_tanggal(Request $request)
    {
        $tanggal = $request->tanggal;

        if ($tanggal < Carbon::now()->toDateString()) {
            return response()->json(['pesan'=>'Masukkan Tanggal Dengan Benar']);
        }else {
            return response()->json(['pesan'=>'']);
        }

    }

    public function total_harga_produk(Request $request)
    {
        $quantitas = $request->quantitas;
        $harga = $request->harga;
        $berat = $request->berat;

        $total = rupiah($quantitas * $harga);
        $total2 = $quantitas * $harga;
        $total_berat = $quantitas * $berat;

        return response()->json(['harga' => $total, 'total' => $total2, 'berat' => $total_berat]);
    }

    public function terjemahan(Request $request)
    {
        $kata_kunci = $request->kata_kunci;

        $hasil = Kamus::where('kata_kunci','like',"%".$kata_kunci."%")->pluck('terjemahan', 'kata_kunci');
        $check = Kamus::where('kata_kunci','like',"%".$kata_kunci."%")->first();

        if ($check == null) {
            return response()->json(['hasil' => 'kosong']);
        } else {
            return response()->json($hasil);
        }
    }

    public function checkSewa(Request $request)
    {
        $qr_code = $request->qr_code;

        $check = WisataTransaksi::where('qr_code', $qr_code)->first();
        $now = Carbon::now();
        $noww = $now->toDateString();

        $jumlah = '';

        if ($check->jumlah_orang === null) {
            $jumlah = $check->wisata->nama_wisata .' : ' . $check->jam_sewa;
            $tanggal = Carbon::parse($check->tanggal_sewa)->translatedFormat('l, d F Y');
            if ($check->user->roles == 'ADMIN') {
                $nama = 'Admin';
            }elseif ($check->user->roles == 'USER') {
                $nama = $check->user->name;
            }
        } else {
            $jumlah = $check->wisata->nama_wisata .' : '. $check->jumlah_orang . ' Orang';
            $tanggal = Carbon::parse($check->tanggal_tiket)->translatedFormat('l, d F Y');
            if ($check->user->roles == 'ADMIN') {
                $nama = 'Admin';
            }elseif ($check->user->roles == 'USER') {
                $nama = $check->user->name;
            }
        }

        if ($check === null) {
            return response()->json(['hasil' => 'tidak-ada']);
        }else {
            if($check->tanggal_tiket === $noww || $check->tanggal_sewa === $noww){
                return response()->json(['hasil' => 'ada', 'jumlah' => $jumlah, 'nama' => $nama]);
            }else {
                return response()->json(['hasil' => 'tidak-ada', 'tanggal' => $tanggal]);
            }
        }
    }

    public function uploadImage(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;

            $request->file('upload')->move(public_path('images'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/'.$fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    public function putHarga(Request $request)
    {
        $id = Wisata::findOrFail($request->id);
        $harga = $id->harga;

        return response()->json(['harga' => $harga, 'id' => $request->id]);
    }

    public function cek_sewa_2(Request $request)
    {
        $jam = $request->jam;
        $tanggal = $request->tanggal;

        $check = WisataTransaksi::where('wisata_id', $request->id)->where('tanggal_sewa', $tanggal)->where('jam_sewa', $jam)->first();

        if ($check == null) {
            return response()->json(['pesan'=>'Bisa Dibooking']);
        }else {
            return response()->json(['pesan'=>'Mohon Maaf.. Sudah Tidak Bisa Dibooking']);
        }
    }

    public function cekTipeWisata(Request $request)
    {
        $id = Wisata::findOrFail($request->id);
        $kategori = $id->kategori;

        if ($kategori == 'wisata' || $kategori == 'tubing') {
            return response()->json(['pesan'=>'wisata']);
        }elseif ($kategori == 'camping' || $kategori == 'glamping') {
            return response()->json(['pesan'=>'camping']);
        }
    }
}
