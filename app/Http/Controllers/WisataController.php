<?php

namespace App\Http\Controllers;

use App\Http\Requests\WisataRequest;
use App\Models\GambarWisata;
use App\Models\Wisata;
use App\Models\WisataTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class WisataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Wisata::all();
        return view('pages.admin.wisata.index', [
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
        return view('pages.admin.wisata.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WisataRequest $request)
    {
        if($request->hari_buka) {
            $hari = array();
            foreach ($request->hari_buka as $value) {
                $hari[] = $value;
            }

            if ($request->file('image')) {

                $check = Wisata::where('nama_wisata', $request->nama_wisata)->first();

                if ($check === null) {
                    $data = array();

                    foreach ($request->file('image') as $value) {
                        $extension = $value->extension();
                        $imageNames = uniqid('img_', microtime()) . '.' . $extension;
                        Storage::putFileAs('public/images/gambar-wisata', $value, $imageNames);
                        // $thumbnailpath = public_path('storage/images/gambar-wisata/' . $imageNames);
                        $img = Image::make(public_path('storage/images/gambar-wisata/' . $imageNames))->resize(600, 400)->save(public_path('storage/images/gambar-wisata/' . $imageNames));
                        $data[] = $imageNames;
                    }

                    $item = new Wisata();
                    $item->nama_wisata = $request->nama_wisata;
                    $item->deskripsi = $request->deskripsi;
                    $item->fasilitas = $request->fasilitas;
                    $item->harga = $request->harga;
                    $item->waktu = $request->waktu;
                    $item->ketentuan = $request->ketentuan;
                    $item->hari_buka = implode('|', $hari);
                    $item->jam_buka = $request->jam_buka;
                    $item->jam_tutup = $request->jam_tutup;
                    $item->kategori = $request->kategori;
                    $item->story = $request->story;
                    $item->wisata_360 = $request->wisata_360;
                    $item->youtube_url = $request->youtube_url;
                    $item->stok = $request->stok;
                    $item->save();

                    foreach ($data as $wisata) {
                        $aa = new GambarWisata();
                        $aa->wisata_id = $item->id;
                        $aa->gambar_url = $wisata;
                        $aa->save();
                    }

                    return redirect()->route('wisata.index')->with('sukses-tambah', 'Sukses');
                }else {
                    return redirect()->back()->withInput()->with('gagal-tambah', 'Gagal');
                }
            }else {
                return redirect()->back()->withInput()->with('gagal-foto', 'Gagal');
            }
        }else {
            return redirect()->back()->withInput()->with('gagal-hari', 'Gagal');
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
        $item = Wisata::findOrFail($id);
        return view('pages.admin.wisata.edit', [
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
    public function update(WisataRequest $request, $id)
    {
        $hari = array();
        foreach ($request->hari_buka as $value) {
            $hari[] = $value;
        }

        $item = Wisata::findOrFail($id);

        $check = Wisata::where('nama_wisata', $request->nama_wisata)->first();

        if (strtolower($request->nama_wisata) === strtolower($item->nama_wisata) || $check === null) {
            if($request->file('image')){
                foreach ($request->file('image') as $value) {
                    $extension = $value->extension();
                    $imageNames = uniqid('img_', microtime()) . '.' . $extension;
                    Storage::putFileAs('public/images/gambar-wisata', $value, $imageNames);
                    $thumbnailpath = public_path('storage/images/gambar-wisata/' . $imageNames);
                    $img = Image::make($thumbnailpath)->resize(600, 400)->save($thumbnailpath);
                    $data[] = $imageNames;
                }
            }

            $item->nama_wisata = $request->nama_wisata;
            $item->deskripsi = $request->deskripsi;
            $item->fasilitas = $request->fasilitas;
            $item->harga = $request->harga;
            $item->waktu = $request->waktu;
            $item->ketentuan = $request->ketentuan;
            $item->hari_buka = implode('|', $hari);
            $item->jam_buka = $request->jam_buka;
            $item->jam_tutup = $request->jam_tutup;
            $item->kategori = $request->kategori;
            $item->story = $request->story;
            $item->wisata_360 = $request->wisata_360;
            $item->youtube_url = $request->youtube_url;
            $item->stok = $request->stok;
            $item->save();

            if ($request->has('image')) {
                $gambar = GambarWisata::where('wisata_id', $id)->get();
                foreach ($gambar as $key => $value) {
                    $filename  = ('public/images/gambar-wisata/').$value->gambar_url;
                    Storage::delete($filename);
                    $value->delete();
                }
                foreach ($data as $wisata) {
                    $aa = new GambarWisata();
                    $aa->wisata_id = $item->id;
                    $aa->gambar_url = $wisata;
                    $aa->save();
                }
            }
            return redirect()->route('wisata.index')->with('sukses-ubah', 'Sukses');
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
        $item = Wisata::findOrFail($id);

        $check = WisataTransaksi::where('wisata_id', $id)->first();

        if ($check === null) {
            $gambar = GambarWisata::where('wisata_id', $id)->get();
            foreach ($gambar as $key => $value) {
                $filename  = ('public/images/gambar-wisata/').$value->gambar_url;
                Storage::delete($filename);
                $value->delete();
            }

            $item->delete();

            return redirect()->route('wisata.index')->with('sukses-hapus', 'Sukses');
        } else {
            return redirect()->back()->with('gagal-hapus', 'Gagal');
        }
    }

    public function buka($id)
    {
        $item = Wisata::findOrfail($id);
        $item->status = 0;
        $item->save();

        return redirect()->route('wisata.index');
    }

    public function tutup($id)
    {
        $item = Wisata::findOrfail($id);
        $item->status = 1;
        $item->save();

        return redirect()->route('wisata.index');
    }
}
