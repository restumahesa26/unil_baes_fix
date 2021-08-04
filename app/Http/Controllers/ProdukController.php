<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdukRequest;
use App\Models\GambarProduk;
use App\Models\Produk;
use App\Models\ProdukTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Produk::select(['id', 'nama_produk', 'stok', 'harga', 'status'])->get();
        return view('pages.admin.produk.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.produk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdukRequest $request)
    {
        $data = array();

        if ($request->file('image')) {

            $check = Produk::where('nama_produk', $request->nama_produk)->first();

            if ($check === null) {
                foreach ($request->file('image') as $value) {
                    $extension = $value->extension();
                    $imageNames = uniqid('img_', microtime()) . '.' . $extension;
                    Storage::putFileAs('public/images/gambar-produk', $value, $imageNames);
                    $thumbnailpath = public_path('storage/images/gambar-produk/' . $imageNames);
                    $img = Image::make($thumbnailpath)->resize(600, 600)->save($thumbnailpath);
                    $data[] = $imageNames;
                }

                $item = new Produk();
                $item->nama_produk = $request->nama_produk;
                $item->kategori = $request->kategori;
                $item->deskripsi = $request->deskripsi;
                $item->stok = $request->stok;
                $item->berat = $request->berat;
                $item->harga = $request->harga;
                $item->story = $request->story;
                $item->save();

                foreach ($data as $produc) {
                    $aa = new GambarProduk();
                    $aa->produk_id = $item->id;
                    $aa->gambar_url = $produc;
                    $aa->save();
                }

                return redirect()->route('produk.index')->with('sukses-tambah', 'Sukses');
            } else {
                return redirect()->back()->withInput()->with('gagal-tambah', 'Gagal');
            }
        } else {
            return redirect()->back()->withInput()->with('gagal-foto', 'Gagal');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Produk::findOrFail($id);
        return view('pages.admin.produk.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdukRequest $request, $id)
    {
        $data = array();

        $item = Produk::findOrFail($id);

        $check = Produk::where('nama_produk', $request->nama_produk)->first();

        if (strtolower($request->nama_produk) === strtolower($item->nama_produk) || $check === null) {
            if($request->file('image')){
                foreach ($request->file('image') as $value) {
                    $extension = $value->extension();
                    $imageNames = uniqid('img_', microtime()) . '.' . $extension;
                    Storage::putFileAs('public/images/gambar-produk', $value, $imageNames);
                    $thumbnailpath = public_path('storage/images/gambar-produk/' . $imageNames);
                    $img = Image::make($thumbnailpath)->resize(600, 600)->save($thumbnailpath);
                    $data[] = $imageNames;
                }
            }

            $item->nama_produk = $request->nama_produk;
            $item->kategori = $request->kategori;
            $item->deskripsi = $request->deskripsi;
            $item->stok = $request->stok;
            $item->berat = $request->berat;
            $item->harga = $request->harga;
            $item->story = $request->story;
            $item->save();

            if ($request->has('image')) {
                $gambar = GambarProduk::where('produk_id', $id)->get();
                foreach ($gambar as $key => $value) {
                    $filename  = ('public/images/gambar-produk/').$value->gambar_url;
                    Storage::delete($filename);
                    $value->delete();
                }
                foreach ($data as $produc) {
                    $aa = new GambarProduk();
                    $aa->produk_id = $item->id;
                    $aa->gambar_url = $produc;
                    $aa->save();
                }
            }

            return redirect()->route('produk.index')->with('sukses-ubah', 'Sukses');
        }else {
            return redirect()->back()->with('gagal-ubah', 'Gagal');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Produk::findOrFail($id);

        $check = ProdukTransaksi::where('produk_id', $id)->first();

        if ($check === null) {
            $gambar = GambarProduk::where('produk_id', $id)->get();
            foreach ($gambar as $key => $value) {
                $filename  = ('public/images/gambar-produk/').$value->gambar_url;
                Storage::delete($filename);
                $value->delete();
            }

            $item->delete();

            return redirect()->route('produk.index')->with('sukses-hapus', 'Sukses');
        } else {
            return redirect()->back()->with('gagal-hapus', 'Gagal');
        }
    }

    public function tersedia($id)
    {
        $item = Produk::findOrfail($id);
        $item->status = 0;
        $item->save();

        return redirect()->route('produk.index');
    }

    public function tidakTersedia($id)
    {
        $item = Produk::findOrfail($id);
        $item->status = 1;
        $item->save();

        return redirect()->route('produk.index');
    }
}
