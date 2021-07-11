<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Informasi::all();
        return view('pages.admin.informasi.index', [
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
        return view('pages.admin.informasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'informasi' => 'required|string|max:255'
        ]);

        $data = $request->except(['_token']);
        Informasi::create($data);

        return redirect()->route('informasi.index')->with('sukses-tambah', 'Sukses');
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
        $item = Informasi::findOrFail($id);

        return view('pages.admin.informasi.edit', [
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
        $request->validate([
            'informasi' => 'required|string|max:255'
        ]);

        $data = $request->except(['_token']);

        $item = Informasi::findOrFail($id);
        $item->update($data);

        return redirect()->route('informasi.index')->with('sukses-ubah', 'Sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Informasi::findOrFail($id);
        $item->delete();

        return redirect()->route('informasi.index')->with('sukses-hapus', 'Sukses');
    }
}
