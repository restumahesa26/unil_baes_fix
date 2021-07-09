<?php

namespace App\Http\Controllers;

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

        return redirect()->route('e-ticket.index');
    }

    public function batal_pembayaran($id)
    {
        $item = WisataTransaksi::findOrFail($id);
        $item->status_bayar = 'belum-bayar';
        $filename = ('public/images/bukti-bayar-tiket/').$item->bukti_bayar;
        Storage::delete($filename);
        $item->bukti_bayar = NULL;
        $item->save();

        return redirect()->route('e-ticket.index');
    }

    public function batal_tiket($id)
    {
        $item = WisataTransaksi::findOrFail($id);
        $filename  = ('public/images/bukti-bayar-tiket/').$item->bukti_bayar;
        Storage::delete($filename);
        $item->delete();

        return redirect()->route('e-ticket.index');
    }
}
