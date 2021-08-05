<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Galeri::all();

        return view('pages.admin.galeri.index', [
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
        return view('pages.admin.galeri.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $value = $request->file('image_url');
        $extension = $value->extension();
        $imageNames = uniqid('img_', microtime()) . '.' . $extension;
        Storage::putFileAs('public/images/galeri', $value, $imageNames);
        $thumbnailpath = storage_path('app/public/images/galeri/' . $imageNames);
        $img = Image::make($thumbnailpath)->resize(800, 600)->save($thumbnailpath);

        $item = new Galeri();
        $item->image_url = $imageNames;
        $item->save();

        return redirect()->route('galeri.index');
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
        $item = Galeri::findOrFail($id);

        return view('pages.admin.galeri.edit', [
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
    public function update(Request $request, $id)
    {
        $item = Galeri::findOrFail($id);
        $value = $request->file('image_url');

        if ($value) {
            $value = $request->file('image_url');
            $extension = $value->extension();
            $imageNames = uniqid('img_', microtime()) . '.' . $extension;
            Storage::putFileAs('public/images/galeri', $value, $imageNames);
            $thumbnailpath = storage_path('app/public/images/galeri/' . $imageNames);
            $img = Image::make($thumbnailpath)->resize(800, 600)->save($thumbnailpath);

            $filename  = ('public/images/galeri/').$item->image_url;
            Storage::delete($filename);
        }else {
            $imageNames = $item->image_url;
        }

        $item->image_url = $imageNames;
        $item->save();

        return redirect()->route('galeri.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Galeri::findOrFail($id);
        $filename  = ('public/images/galeri/').$item->image_url;
        Storage::delete($filename);
        $item->delete();

        return redirect()->route('galeri.index');
    }
}
