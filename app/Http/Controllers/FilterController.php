<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\ProdukTransaksi;
use App\Models\Wisata;
use App\Models\WisataTransaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function eticketFilter(Request $request)
    {
        if ($request->filter == null) {
            if ($request->filter_tanggal != null) {
                $items = WisataTransaksi::whereBetween('created_at', [$request->filter_tanggal, Carbon::now()->addDay()->toDateString()])->get();

                if ($items->count() >= 1) {
                    return view('pages.admin.e-ticket.index', [
                        'items' => $items
                    ]);
                } else {
                    return redirect()->route('e-ticket.index')->with('data-kosong', 'Pilih');
                }
            } else {
                return redirect()->route('e-ticket.index')->with('pilih-tanggal', 'Pilih');
            }
        } else {
            $items = WisataTransaksi::orderBy('id', 'DESC');
            $tgl = '';
            if ($request->filter == 'hari-ini') {
                $tgl = Carbon::now();
                $tgl = $tgl->toDateString();
                $items = WisataTransaksi::orderBy('id', 'DESC')->whereDate('created_at', $tgl)->orWhere('updated_at', $tgl)->get();
            }elseif ($request->filter == 'belum-konfirmasi') {
                $items = WisataTransaksi::orderBy('id', 'DESC')->where('status_bayar', 'menunggu-konfirmasi')->get();
            }elseif ($request->filter == 'belum-bayar') {
                $items = WisataTransaksi::orderBy('id', 'DESC')->where('status_bayar', 'belum-bayar')->get();
            }

            $count = $items->count();

            if ($count >= 1) {
                return view('pages.admin.e-ticket.index', [
                    'items' => $items
                ]);
            }else {
                return redirect()->route('e-ticket.index')->with('data-kosong', 'Kosong');
            }
        }
    }

    public function ecommerceFilter(Request $request)
    {
        if ($request->filter == null) {
            if ($request->filter_tanggal != null) {
                $items = ProdukTransaksi::whereBetween('created_at', [$request->filter_tanggal, Carbon::now()->addDay()->toDateString()])->get();

                if ($items->count() >= 1) {
                    return view('pages.admin.e-commerce.index', [
                        'items' => $items
                    ]);
                } else {
                    return redirect()->route('e-commerce.index')->with('data-kosong', 'Kosong');
                }
            } else {
                return redirect()->route('e-commerce.index')->with('pilih-filter', 'Pilih');
            }
        } else {
            $items = ProdukTransaksi::orderBy('id', 'DESC');
            $tgl = '';
            if ($request->filter == 'hari-ini') {
                $tgl = Carbon::now();
                $tgl = $tgl->toDateString();
                $items = ProdukTransaksi::orderBy('id', 'DESC')->whereDate('created_at', $tgl)->orWhere('updated_at', $tgl)->get();
            }elseif ($request->filter == 'belum-konfirmasi') {
                $items = ProdukTransaksi::orderBy('id', 'DESC')->where('status_bayar', 'menunggu-konfirmasi')->get();
            }elseif ($request->filter == 'belum-bayar') {
                $items = ProdukTransaksi::orderBy('id', 'DESC')->where('status_bayar', 'belum-bayar')->get();
            }elseif ($request->filter == 'belum-set-pengiriman') {
                $items = ProdukTransaksi::orderBy('id', 'DESC')->where('status_pengiriman', NULL)->where('status_bayar', 'sudah-bayar')->get();
            }elseif ($request->filter == 'belum-bayar-ongkir') {
                $items = ProdukTransaksi::orderBy('id', 'DESC')->where('status_pengiriman', 'bayar-ongkir')->get();
            }elseif ($request->filter == 'belum-konfirmasi-ongkir') {
                $items = ProdukTransaksi::orderBy('id', 'DESC')->where('status_pengiriman', 'sudah-bayar-ongkir')->get();
            }

            $count = $items->count();

            if ($count >= 1) {
                return view('pages.admin.e-commerce.index', [
                    'items' => $items
                ]);
            }else {
                return redirect()->route('e-commerce.index')->with('data-kosong', 'Kosong');
            }
        }
    }

    public function produk_filter(Request $request)
    {
        if ($request->filter == null) {
            return redirect()->route('produk.index')->with('pilih-filter', 'Pilih');
        } else {
            $items = Produk::orderBy('id', 'DESC');
            if ($request->filter === 'tersedia') {
                $items = Produk::orderBy('id', 'DESC')->where('status', 0)->get();
            }elseif ($request->filter === 'tidak-tersedia') {
                $items = Produk::orderBy('id', 'DESC')->where('status', 1)->get();
            }

            $count = $items->count();

            if ($count >= 1) {
                return view('pages.admin.produk.index', [
                    'items' => $items
                ]);
            }else {
                return redirect()->route('produk.index')->with('data-kosong', 'Kosong');
            }
        }
    }

    public function wisata_filter(Request $request)
    {
        if ($request->filter == null) {
            return redirect()->route('wisata.index')->with('pilih-filter', 'Pilih');
        } else {
            $items = Wisata::orderBy('id', 'DESC');
            if ($request->filter === 'buka') {
                $items = Wisata::orderBy('id', 'DESC')->where('status', 0)->get();
            }elseif ($request->filter === 'tutup') {
                $items = Wisata::orderBy('id', 'DESC')->where('status', 1)->get();
            }

            $count = $items->count();

            if ($count >= 1) {
                return view('pages.admin.wisata.index', [
                    'items' => $items
                ]);
            }else {
                return redirect()->route('wisata.index')->with('data-kosong', 'Kosong');
            }
        }
    }
}
