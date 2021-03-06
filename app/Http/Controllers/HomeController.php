<?php

namespace App\Http\Controllers;

use App\Models\CeritaRakyat;
use App\Models\EmailSubscribe;
use App\Models\Galeri;
use App\Models\Informasi;
use App\Models\Kamus;
use App\Models\KritikSaran;
use App\Models\Produk;
use App\Models\ProdukTransaksi;
use App\Models\Referensi;
use App\Models\Review;
use App\Models\SerbaSerbi;
use App\Models\User;
use App\Models\Wisata;
use App\Models\WisataTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade as PDF;

class HomeController extends Controller
{
    public function home()
    {
        $review = "";
        if (Auth::user()) {
            $review = Review::where('user_id', Auth::user()->id)->first();
        }
        $referensi = Referensi::first();
        $reviews = Review::where('active', 0)->inRandomOrder()->get();
        $wisata = Wisata::select(['id', 'nama_wisata', 'kategori', 'deskripsi'])->inRandomOrder()->where('status', 0)->paginate(3);
        $wisata2 = Wisata::count();
        $cerita = CeritaRakyat::select(['id', 'judul', 'deskripsi', 'gambar_cerita'])->inRandomOrder()->paginate(3);
        $produk = Produk::select(['id', 'nama_produk', 'kategori', 'deskripsi', 'harga'])->inRandomOrder()->where('status', 0)->paginate(4);
        $galeri = Galeri::inRandomOrder()->get();
        $informasi = Informasi::where('status', 0)->get();
        return view('pages.user.home', [
            'wisatas' => $wisata, 'ceritas' => $cerita, 'produks' => $produk, 'review' => $review, 'reviews' => $reviews,
            'referensis' => $referensi, 'galeris' => $galeri, 'informasis' => $informasi, 'wisata2' => $wisata2
        ]);
    }

    public function wisata()
    {
        $wisata = Wisata::with('gambar_wisata')->select(['id', 'nama_wisata', 'kategori', 'deskripsi', 'status'])->paginate(6);
        return view('pages.user.wisata', [
            'wisatas' => $wisata
        ]);
    }

    public function produk()
    {
        $produk = Produk::with('gambar_produk')->select(['id', 'nama_produk', 'kategori', 'deskripsi', 'harga', 'stok'])->paginate(6);
        return view('pages.user.produk', [
            'produks' => $produk
        ]);
    }

    public function cerita_rakyat()
    {
        $cerita = CeritaRakyat::select(['id', 'judul', 'deskripsi', 'gambar_cerita'])->paginate(6);
        return view('pages.user.cerita-rakyat', [
            'ceritas' => $cerita
        ]);
    }

    public function cerita_rakyat_detail($id)
    {
        $item = CeritaRakyat::findOrFail($id);
        return view('pages.user.cerita-rakyat-detail', [
            'item' => $item
        ]);
    }

    public function wisata_detail($id)
    {
        $item = Wisata::findOrFail($id);

        return view('pages.user.wisata-detail', [
            'item' => $item
        ]);
    }

    public function transaksi()
    {
        $wisata = WisataTransaksi::with(['user', 'wisata'])->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        $produk = ProdukTransaksi::with(['produk', 'kelurahan', 'kecamatan', 'kota', 'provinsi', 'user'])->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();

        return view('pages.user.transaksi', [
            'wisatas' => $wisata, 'produks' => $produk
        ]);
    }

    public function produk_detail($id)
    {
        $item = Produk::findOrFail($id);

        return view('pages.user.produk-detail', [
            'item' => $item
        ]);
    }

    public function serba_serbi()
    {
        $serba = SerbaSerbi::first();
        return view('pages.user.serba-serbi', [
            'serbas' => $serba
        ]);
    }

    public function store_review(Request $request)
    {
        $item = new Review();
        $item->user_id = Auth::user()->id;
        $item->review = $request->review;
        $item->save();

        return redirect()->route('home')->with('berhasil-review', 'Berhasil Kritik');
    }

    public function kamus()
    {
        return view('pages.user.kamus');
    }

    public function store_kritik(Request $request)
    {
        $item = new KritikSaran();
        $item->user_id = Auth::user()->id;
        $item->kritik_saran = $request->kritik_saran;
        $item->save();

        return redirect()->route('home')->with('berhasil-kritik', 'Berhasil Kritik');
    }

    public function profileEdit(Request $request)
    {
        return view('pages.user.profile', [
            'user' => $request->user()
        ]);
    }

    public function profileUpdate(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'pekerjaan' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'numeric'],
            'jenis_kelamin' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)]
        ]);

        $user->update([
            'name' => $request->name,
            'pekerjaan' => $request->pekerjaan,
            'no_hp' => $request->no_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email,
        ]);

        return redirect()->route('profile.edit');
    }

    public function subscribeEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:email_subscribes'
        ]);

        $data = $request->except(['_token']);

        EmailSubscribe::create($data);

        return redirect()->route('home')->with('success-subscribe', 'Sukses');
    }

    public function downloadKamus()
    {
        $items = Kamus::all();

        $pdf = PDF::loadview('pages.pdf.kamus', [
            'items' => $items
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('E-book Kamus.pdf');

    }
}
