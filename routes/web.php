<?php

use App\Models\CeritaRakyat;
use App\Models\Kamus;
use App\Models\KritikSaran;
use App\Models\Produk;
use App\Models\ProdukTransaksi;
use App\Models\Review;
use App\Models\Wisata;
use App\Models\WisataTransaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@home')->name('home');

Route::get('/wisata', 'HomeController@wisata')->name('wisata');

Route::get('/produk', 'HomeController@produk')->name('produk');

Route::get('/cerita-rakyat', 'HomeController@cerita_rakyat')->name('cerita-rakyat');

Route::get('/kamus-bahasa-daerah', 'HomeController@kamus')->name('kamus-bahasa-daerah');

Route::get('/cerita-rakyat/detail/{id}/', 'HomeController@cerita_rakyat_detail')->name('cerita-rakyat-detail');

Route::get('/wisata/detail/{id}/', 'HomeController@wisata_detail')->name('wisata-detail');

Route::get('/produk/detail/{id}/', 'HomeController@produk_detail')->name('produk-detail');

Route::get('/serba-serbi-desa-rindu-hati', 'HomeController@serba_serbi')->name('serba-serbi');

Route::get('/terjemahkan', 'APIController@terjemahan')->name('terjemahan.api');

Route::group(['middleware' => 'auth:sanctum', 'verified'], function () {
    Route::get('/wisata/detail/beli-tiket/{id}/', 'TransaksiController@beli_tiket')->name('beli-tiket');

    Route::get('/wisata/detail/sewa/{id}/', 'TransaksiController@sewa')->name('sewa');

    Route::get('/produk/detail/beli-produk/{id}/', 'TransaksiController@beli_produk')->name('beli-produk');

    Route::get('/total/harga-tiket', 'APIController@total_harga_tiket')->name('total-harga-tiket.api');

    Route::get('/total/harga-produk', 'APIController@total_harga_produk')->name('total-harga-produk.api');

    Route::get('/cek-sewa/{id}/', 'APIController@cek_sewa')->name('cek-sewa.api');

    Route::get('/cek-hari', 'APIController@cek_hari')->name('cek-hari.api');

    Route::get('/cek-tanggal', 'APIController@cek_tanggal')->name('cek-tanggal.api');

    Route::post('/wisata/bayar-tiket', 'TransaksiController@bayar_tiket')->name('bayar-tiket');

    Route::post('/wisata/bayar-sewa', 'TransaksiController@bayar_sewa')->name('bayar-sewa');

    Route::post('/produk/konfirmasi-produk', 'TransaksiController@konfirmasi_produk')->name('konfirmasi-produk');

    Route::get('/transaksi/wisata/bayar-tiket/{id}/', 'TransaksiController@bayar_tiket_show')->name('bayar-tiket-show');

    Route::get('/transaksi/produk/bayar-produk/{id}/', 'TransaksiController@bayar_produk_show')->name('bayar-produk-show');

    Route::get('/transaksi/produk/bayar-ongkos-kirim/{id}/', 'TransaksiController@bayar_ongkos_kirim')->name('bayar-ongkos-kirim');

    Route::post('/transaksi/produk/bayar-ongkos-kirim/{id}/proses', 'TransaksiController@proses_ongkos_kirim')->name('proses-pembayaran-ongkos-kirim');

    Route::get('/transaksi', 'HomeController@transaksi')->name('transaksi');

    Route::get('/transaksi/cetak-e-ticket/{id}/', 'TransaksiController@pdf_tiket')->name('pdf-tiket');

    Route::get('/transaksi/cetak-e-ticket-sewa/{id}/', 'TransaksiController@pdf_sewa')->name('pdf-sewa');

    Route::get('/transaksi/cetak-invoice-produk/{id}/', 'TransaksiController@pdf_invoice')->name('pdf-invoice');

    Route::delete('/transaksi/wisata/batal-tiket/{id}/', 'TransaksiController@batal_tiket')->name('batal-tiket');

    Route::post('/transaksi/wisata/bayar-tiket/{id}/proses', 'TransaksiController@proses_tiket')->name('proses-tiket');

    Route::post('/transaksi/produk/bayar-produk/{id}/proses', 'TransaksiController@proses_pembayaran_produk')->name('proses-pembayaran-produk');

    Route::get('/provinsi/kabupaten', 'ProvinsiController@kabupaten')->name('provinsi.kabupaten');

    Route::get('/provinsi/kabupaten/kecamatan', 'ProvinsiController@kecamatan')->name('provinsi.kecamatan');

    Route::get('/provinsi/kabupaten/kecamatan/kelurahan', 'ProvinsiController@kelurahan')->name('provinsi.kelurahan');

    Route::post('/review/store', 'HomeController@store_review')->name('review.store');

    Route::delete('/e-ticket/batal-tiket/{id}/', 'ETicketController@batal_tiket')->name('e-ticket.batal-tiket');

    Route::delete('/e-commerce/batal-produk/{id}/', 'TransaksiController@delete_produk')->name('e-commerce.batal-produk');

    Route::post('/kritik-saran/store', 'HomeController@store_kritik')->name('kritik-saran.store');

    Route::get('/profile', 'HomeController@profileEdit')->name('profile.edit');

    Route::patch('profile/update', 'HomeController@profileUpdate')->name('profile.update');

    Route::post('/subscribe-email', 'HomeController@subscribeEmail')->name('subscribe-email');
});

Route::prefix('admin')
    ->middleware(['auth:sanctum', 'verified', 'admin'])
    ->group(function () {

        Route::get('/', function () {
            $wisata = Wisata::count();
            $produk = Produk::count();
            $cerita = CeritaRakyat::count();
            $kamus = Kamus::count();
            $e_ticket = WisataTransaksi::where('status_bayar', 'menunggu-konfirmasi')->count();
            $e_commerce = ProdukTransaksi::where('status_bayar', 'menunggu-konfirmasi')->count();
            $e_commerce_2 = ProdukTransaksi::where('status_pengiriman', 'sudah-bayar-ongkir')->orWhere('status_pengiriman', NULL)->count();
            $review = Review::count();
            $kritik = KritikSaran::whereDate('updated_at', Carbon::now()->toDateString())->get();
            return view('pages.admin.dashboard', [
                'wisata' => $wisata, 'produk' => $produk, 'cerita' => $cerita, 'kamus' => $kamus, 'e_ticket' => $e_ticket, 'e_commerce' => $e_commerce, 'e_commerce_2' => $e_commerce_2, 'review' => $review, 'kritik' => $kritik
            ]);
        })->name('dashboard');

        Route::resource('cerita-rakyat', 'CeritaRakyatController');

        Route::resource('wisata', 'WisataController');

        Route::get('wisata/{id}/buka', 'WisataController@buka')->name('wisata.buka');

        Route::get('wisata/{id}/tutup', 'WisataController@tutup')->name('wisata.tutup');

        Route::resource('produk', 'ProdukController');

        Route::get('produk/{id}/tersedia', 'ProdukController@tersedia')->name('produk.tersedia');

        Route::get('produk/{id}/tidak-tersedia', 'ProdukController@tidakTersedia')->name('produk.tidak-tersedia');

        Route::resource('rekening', 'RekeningController');

        Route::resource('kamus', 'KamusController');

        Route::resource('galeri', 'GaleriController');

        Route::resource('informasi', 'InformasiController');

        Route::get('/informasi/aktif/{id}/', 'InformasiController@aktif')->name('informasi.aktif');

        Route::get('/informasi/tidak-aktif/{id}/', 'InformasiController@tidakAktif')->name('informasi.tidak-aktif');

        Route::get('/e-ticket', 'ETicketController@index')->name('e-ticket.index');

        Route::get('/e-ticket/tambah-data', 'ETicketController@tambahData')->name('e-ticket.create');

        Route::post('/e-ticket/tambah-data/store', 'ETicketController@storeData')->name('e-ticket.store');

        Route::get('/e-ticket/bukti-bayar/{id}/', 'ETicketController@lihat_bukti_bayar')->name('e-ticket.bukti-bayar');

        Route::get('/e-ticket/konfirmasi-pembayaran/{id}/', 'ETicketController@konfirmasi_bayar')->name('e-ticket.konfirmasi-pembayaran');

        Route::get('/e-ticket/batal-pembayaran/{id}/', 'ETicketController@batal_pembayaran')->name('e-ticket.batal-pembayaran');

        Route::get('/e-commerce', 'ECommerceController@index')->name('e-commerce.index');

        Route::get('/e-commerce/bukti-bayar/{id}/', 'ECommerceController@lihat_bukti_bayar')->name('e-commerce.bukti-bayar');

        Route::get('/e-commerce/pilih-pengiriman/{id}/', 'ECommerceController@metode_pengiriman')->name('e-commerce.pilih-pengiriman');

        Route::put('/e-commerce/set-pengiriman/{id}/', 'ECommerceController@set_pengiriman')->name('e-commerce.set-pengiriman');

        Route::get('/e-commerce/konfirmasi-pembayaran/{id}/', 'ECommerceController@konfirmasi_bayar')->name('e-commerce.konfirmasi-pembayaran');

        Route::get('/e-commerce/bukti-ongkos-kirim/{id}/', 'ECommerceController@lihat_ongkos_kirim')->name('e-commerce.bukti-ongkos-kirim');

        Route::put('/e-commerce/kirim-pesanan/{id}/', 'ECommerceController@kirim_pesanan')->name('e-commerce.kirim-pesanan');

        Route::get('/e-commerce/batal-pembayaran/{id}/', 'ECommerceController@batal_pembayaran')->name('e-commerce.batal-pembayaran');

        Route::get('/e-commerce/batal-pembayaran-ongkir/{id}/', 'ECommerceController@batal_pembayaran_ongkir')->name('e-commerce.batal-pembayaran-ongkir');

        Route::get('/review', 'ReviewController@index')->name('review.index');

        Route::get('/put-harga/api', 'APIController@putHarga')->name('put-harga.api');

        Route::get('/cek-sewa', 'APIController@cek_sewa_2')->name('cek-sewa-2.api');

        Route::get('/cek-kategori-wisata', 'APIController@cekTipeWisata')->name('cek-kategori-wisata.api');

        Route::get('/review/aktif/{id}/', 'ReviewController@buat_aktif')->name('review.aktif');

        Route::get('/review/tidak-aktif/{id}/', 'ReviewController@buat_tidak_aktif')->name('review.tidak-aktif');

        Route::delete('/review/delete/{id}/', 'ReviewController@destroy')->name('review.destroy');

        Route::get('/referensi', 'ReferensiController@index')->name('referensi.index');

        Route::get('/referensi/create', 'ReferensiController@create')->name('referensi.create');

        Route::post('/referensi/store', 'ReferensiController@store')->name('referensi.store');

        Route::get('/referensi/edit/{id}/', 'ReferensiController@edit')->name('referensi.edit');

        Route::put('/referensi/update/{id}/', 'ReferensiController@update')->name('referensi.update');

        Route::get('/serba-serbi', 'ReferensiController@serba_serbi_index')->name('serba-serbi.index');

        Route::get('/serba-serbi/create', 'ReferensiController@serba_serbi_create')->name('serba-serbi.create');

        Route::post('/serba-serbi/store', 'ReferensiController@serba_serbi_store')->name('serba-serbi.store');

        Route::get('/serba-serb/edit/{id}/', 'ReferensiController@serba_serbi_edit')->name('serba-serbi.edit');

        Route::put('/serba-serbi/update/{id}/', 'ReferensiController@serba_serbi_update')->name('serba-serbi.update');

        Route::get('/qr-code', 'QRCodeController@index')->name('qr-code.index');

        Route::get('/qr-code/check-sewa', 'APIController@checkSewa')->name('check-sewa.api');

        Route::get('/user-admin', 'ProfileController@index')->name('profile.index');

        Route::get('/user-admin/set-admin/{id}/', 'ProfileController@setAdmin')->name('profile.set-admin');

        Route::get('/user-admin/set-user/{id}/', 'ProfileController@setUser')->name('profile.set-user');

        Route::delete('/user-admin/delete-user/{id}/', 'ProfileController@deleteUserAdmin')->name('profile.delete-user-admin');

        Route::delete('/email-subscribe/{id}/', 'ProfileController@deleteEmail')->name('delete-subscribe-email');

        Route::get('/kritik-saran', 'KritikSaranController@index')->name('kritik-saran.index');

        Route::delete('/kritik-saran/delete/{id}/', 'KritikSaranController@destroy')->name('kritik-saran.destroy');

        Route::post('/upload_image','APIController@uploadImage')->name('upload');

        Route::delete('/e-commerce/batal-pesanan/{id}/', 'ECommerceController@deleteECommerce')->name('e-commerce.batal-pesanan');

        Route::get('/e-ticket/filter', 'FilterController@eticketFilter')->name('e-ticket-filter');

        Route::get('/e-commerce/filter', 'FilterController@ecommerceFilter')->name('e-commerce-filter');

        Route::get('/produk-show/filter', 'FilterController@produk_filter')->name('produk-filter');

        Route::get('/wisata-show/filter', 'FilterController@wisata_filter')->name('wisata-filter');

        Route::get('/kirim-email-informasi/{id}/', 'EmailController@emailInformasi')->name('kirim-email-informasi');

    });
