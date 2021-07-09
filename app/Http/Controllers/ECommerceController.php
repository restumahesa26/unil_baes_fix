<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\ProdukTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ECommerceController extends Controller
{
    public function index()
    {
        $items = ProdukTransaksi::orderBy('id', 'DESC')->get();
        return view('pages.admin.e-commerce.index', [
            'items' => $items
        ]);
    }

    public function lihat_bukti_bayar($id)
    {
        $item = ProdukTransaksi::findOrFail($id);

        return view('pages.admin.e-commerce.bukti-bayar', [
            'item' => $item
        ]);
    }

    public function batal_pembayaran($id)
    {
        $item = ProdukTransaksi::findOrFail($id);
        $item->status_bayar = 'belum-bayar';
        $filename = ('public/images/bukti-bayar-produk/').$item->bukti_bayar;
        Storage::delete($filename);
        $item->bukti_bayar = NULL;
        $item->save();

        return redirect()->route('e-commerce.index');
    }

    public function batal_pembayaran_ongkir($id)
    {
        $item = ProdukTransaksi::findOrFail($id);
        $item->status_pengiriman = 'bayar-ongkir';
        $filename = ('public/images/bukti-bayar-ongkos-kirim/').$item->bukti_bayar_2;
        Storage::delete($filename);
        $item->bukti_bayar_2 = NULL;
        $item->save();

        return redirect()->route('e-commerce.index');
    }

    public function metode_pengiriman($id)
    {
        $item = ProdukTransaksi::findOrFail($id);

        return view('pages.admin.e-commerce.pilih-pengiriman', [
            'item' => $item
        ]);
    }

    public function konfirmasi_bayar($id)
    {
        $item = ProdukTransaksi::findOrFail($id);

        $item->status_bayar = 'sudah-bayar';
        $item->save();

        return redirect()->route('e-commerce.index');
    }

    public function set_pengiriman(Request $request, $id)
    {
        $item = ProdukTransaksi::findOrFail($id);
        $item->metode_pengiriman = $request->metode_pengiriman;
        $item->ongkos_kirim = $request->ongkos_kirim;
        $item->status_pengiriman = 'bayar-ongkir';
        $item->save();

        return redirect()->route('e-commerce.index');
    }

    public function lihat_ongkos_kirim($id)
    {
        $item = ProdukTransaksi::findOrFail($id);

        return view('pages.admin.e-commerce.bukti-ongkos-kirim', [
            'item' => $item
        ]);
    }

    public function kirim_pesanan(Request $request, $id)
    {
        $item = ProdukTransaksi::findOrFail($id);
        $item->status_pengiriman = 'dikirim';
        $item->kode_resi = $request->kode_resi;
        $item->save();

        return redirect()->route('e-commerce.index');
    }

    public function deleteECommerce($id)
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

        return redirect()->route('e-commerce.index');
    }
}
