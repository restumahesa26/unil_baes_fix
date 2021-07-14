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
        $produk = Produk::all();
        if ($request->filter == null) {
            if ($request->filter_tanggal != null) {
                $items = ProdukTransaksi::whereBetween('created_at', [$request->filter_tanggal, Carbon::now()->addDay()->toDateString()])->get();

                if ($items->count() >= 1) {
                    return view('pages.admin.e-commerce.index', [
                        'items' => $items, 'produks' => $produk
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
                    'items' => $items, 'produks' => $produk
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

    public function laporanETicket(Request $request)
    {
        if ($request->filter == 'semua') {
            $items = WisataTransaksi::where('status_bayar', 'sudah-bayar')->get();

            return view('pages.admin.laporan.e-ticket', [
                'items' => $items
            ]);
        }

        if ($request->filter == 'hari-ini') {
            $items = WisataTransaksi::where('status_bayar', 'sudah-bayar')->whereDate('created_at', Carbon::now()->toDateString())->get();

            return view('pages.admin.laporan.e-ticket', [
                'items' => $items
            ]);
        }

        if ($request->filter == 'tiket-hari-ini') {
            $items = WisataTransaksi::where('status_bayar', 'sudah-bayar')->whereDate('tanggal_tiket', Carbon::now()->toDateString())->orWhereDate('tanggal_sewa', Carbon::now()->toDateString())->get();

            return view('pages.admin.laporan.e-ticket', [
                'items' => $items
            ]);
        }

        if ($request->tanggal_awal || $request->tanggal_akhir) {
            $tglTo = Carbon::parse($request->tanggal_akhir)->addDay()->toDateString();
            $items = WisataTransaksi::all();
            $items = $items->where('status_bayar', 'sudah-bayar')->whereBetween('created_at', [$request->tanggal_awal, $tglTo]);

            return view('pages.admin.laporan.e-ticket', [
                'items' => $items
            ]);
        }

        if ($request->tiket_tanggal_awal || $request->tiket_tanggal_akhir) {
            $tglTo = Carbon::parse($request->tiket_tanggal_akhir)->addDay()->toDateString();
            $items = WisataTransaksi::where('status_bayar', 'sudah-bayar')->whereBetween('tanggal_tiket', [$request->tiket_tanggal_awal, $tglTo])->orWhereBetween('tanggal_sewa', [$request->tiket_tanggal_awal, $tglTo])->get();

            return view('pages.admin.laporan.e-ticket', [
                'items' => $items
            ]);
        }
    }

    public function laporanECommerce(Request $request)
    {
        if ($request->filter == 'semua') {
            $items = ProdukTransaksi::where('status_bayar', 'sudah-bayar')->get();

            return view('pages.admin.laporan.e-commerce', [
                'items' => $items
            ]);
        }

        if ($request->filter == 'hari-ini') {
            $items = ProdukTransaksi::where('status_bayar', 'sudah-bayar')->whereDate('created_at', Carbon::now()->toDateString())->get();

            return view('pages.admin.laporan.e-commerce', [
                'items' => $items
            ]);
        }

        if ($request->tanggal_awal || $request->tanggal_akhir) {
            $tglTo = Carbon::parse($request->tanggal_akhir)->addDay()->toDateString();
            $items = ProdukTransaksi::all();
            $items = $items->where('status_bayar', 'sudah-bayar')->whereBetween('created_at', [$request->tanggal_awal, $tglTo]);

            return view('pages.admin.laporan.e-commerce', [
                'items' => $items
            ]);
        }

        if ($request->produk) {
            $items = ProdukTransaksi::where('produk_id', $request->produk)->get();
            return view('pages.admin.laporan.e-commerce', [
                'items' => $items
            ]);
        }
    }

    public function laporanProduk(Request $request)
    {
        if ($request->filter == 'semua') {
            $items = Produk::all();
            $text = '';

            return view('pages.admin.laporan.produk-laporan', [
                'items' => $items, 'text' => $text
            ]);
        }

        if ($request->kondisi) {
            if ($request->kondisi == 'tersedia') {
                $items = Produk::where('status', 0)->get();
                $text = 'Tersedia';
                return view('pages.admin.laporan.produk-laporan', [
                    'items' => $items, 'text' => $text
                ]);
            }
            if ($request->kondisi == 'tidak-tersedia') {
                $items = Produk::where('status', 1)->get();
                $text = 'Tidak Tersedia';
                return view('pages.admin.laporan.produk-laporan', [
                    'items' => $items, 'text' => $text
                ]);
            }
        }
    }

    public function laporanWisata(Request $request)
    {
        if ($request->filter == 'semua') {
            $items = Wisata::all();
            $text = '';

            return view('pages.admin.laporan.wisata-laporan', [
                'items' => $items, 'text' => $text
            ]);
        }

        if ($request->kondisi) {
            if ($request->kondisi == 'buka') {
                $items = Wisata::where('status', 0)->get();
                $text = 'Buka';
                return view('pages.admin.laporan.wisata-laporan', [
                    'items' => $items, 'text' => $text
                ]);
            }
            if ($request->kondisi == 'tutup') {
                $items = Wisata::where('status', 1)->get();
                $text = 'Tutup';
                return view('pages.admin.laporan.wisata-laporan', [
                    'items' => $items, 'text' => $text
                ]);
            }
        }
    }
}
