<?php

namespace App\Http\Controllers;

use App\Http\Requests\KamusRequest;
use App\Models\Kamus;
use Illuminate\Http\Request;

class KamusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Kamus::all();

        return view('pages.admin.kamus.index', [
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
        return view('pages.admin.kamus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KamusRequest $request)
    {
        $check = Kamus::where('kata_kunci', $request->kata_kunci)->first();

        if ($check === null) {
            $item = new Kamus();
            $item->kata_kunci = $request->kata_kunci;
            $item->terjemahan = $request->terjemahan;
            $item->save();

            return redirect()->route('kamus.index')->with('sukses-tambah', 'Sukses');
        } else {
            return redirect()->back()->withInput()->with('gagal-tambah', 'Gagal');
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
        $item = Kamus::findOrFail($id);

        return view('pages.admin.kamus.edit', [
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
    public function update(KamusRequest $request, $id)
    {
        $item = Kamus::findOrFail($id);

        $check = Kamus::where('kata_kunci', $request->kata_kunci)->first();

        if (strtolower($request->kata_kunci) === strtolower($item->kata_kunci) || $check === null) {
            $item->kata_kunci = $request->kata_kunci;
            $item->terjemahan = $request->terjemahan;
            $item->save();

            return redirect()->route('kamus.index')->with('sukses-ubah', 'Sukses');
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
        $item = Kamus::findOrFail($id);
        $item->delete();

        return redirect()->route('kamus.index')->with('sukses-hapus', 'Sukses');
    }
}
