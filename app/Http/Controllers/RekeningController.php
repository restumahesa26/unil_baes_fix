<?php

namespace App\Http\Controllers;

use App\Http\Requests\RekeningRequest;
use App\Models\Rekening;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Rekening::all();
        return view('pages.admin.rekening.index', [
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
        return view('pages.admin.rekening.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RekeningRequest $request)
    {
        $data = $request->except(['_token']);
        Rekening::create($data);

        return redirect()->route('rekening.index')->with('sukses-tambah', 'Sukses');
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
        $item = Rekening::findOrFail($id);

        return view('pages.admin.rekening.edit', [
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
    public function update(RekeningRequest $request, $id)
    {
        $data = $request->except(['_token']);
        $item = Rekening::findOrFail($id);

        $item->update($data);
        return redirect()->route('rekening.index')->with('sukses-ubah', 'Sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Rekening::findOrFail($id);
        $item->delete();

        return redirect()->route('rekening.index')->with('sukses-hapus', 'Sukses');
    }
}
