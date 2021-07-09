<?php

namespace App\Http\Controllers;

use App\Http\Requests\CeritaRakyatRequest;
use App\Models\CeritaRakyat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class CeritaRakyatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = CeritaRakyat::all();
        return view('pages.admin.cerita-rakyat.index', [
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
        return view('pages.admin.cerita-rakyat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CeritaRakyatRequest $request)
    {
        $value = $request->file('gambar_cerita');
        if ($value) {
            $extension = $value->extension();
            $imageNames = uniqid('img_', microtime()) . '.' . $extension;
            Storage::putFileAs('public/images/gambar-cerita', $value, $imageNames);
            $thumbnailpath = public_path('storage/images/gambar-cerita/' . $imageNames);
            $img = Image::make($thumbnailpath)->resize(600, 400)->save($thumbnailpath);

            $item = new CeritaRakyat();
            $item->judul = $request->judul;
            $item->deskripsi = $request->deskripsi;
            $item->isi_cerita = $request->isi_cerita;
            $item->gambar_cerita = $imageNames;
            $item->save();

            return redirect()->route('cerita-rakyat.index')->with('sukses-tambah', 'Sukses');
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
        $item = CeritaRakyat::findOrFail($id);
        return view('pages.admin.cerita-rakyat.edit', [
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
    public function update(CeritaRakyatRequest $request, $id)
    {
        $value = $request->file('gambar_cerita');
        if($value) {
            $extension = $value->extension();
            $imageNames = uniqid('img_', microtime()) . '.' . $extension;
            Storage::putFileAs('public/images/gambar-cerita', $value, $imageNames);
            $thumbnailpath = public_path('storage/images/gambar-cerita/' . $imageNames);
            $img = Image::make($thumbnailpath)->resize(600, 400)->save($thumbnailpath);
        }

        $item = CeritaRakyat::findOrFail($id);

        $image = $item->gambar_cerita;

        $item->judul = $request->judul;
        $item->deskripsi = $request->deskripsi;
        $item->isi_cerita = $request->isi_cerita;
        if ($value) {
            $item->gambar_cerita = $imageNames;
        }else {
            $item->gambar_cerita = $image;
        }
        $item->save();

        return redirect()->route('cerita-rakyat.index')->with('sukses-ubah', 'Sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = CeritaRakyat::findOrFail($id);
        $item->delete();

        return redirect()->route('cerita-rakyat.index')->with('sukses-hapus', 'Sukses');
    }
}
