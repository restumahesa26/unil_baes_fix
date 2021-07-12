<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReferensiRequest;
use App\Http\Requests\SerbaSerbiRequest;
use App\Models\Referensi;
use App\Models\SerbaSerbi;
use Illuminate\Http\Request;

class ReferensiController extends Controller
{
    public function index()
    {
        $items = Referensi::all();

        return view('pages.admin.referensi.index', [
            'items' => $items
        ]);
    }

    public function create()
    {
        $check = Referensi::all();

        return view('pages.admin.referensi.create', [
            'check' => $check
        ]);
    }

    public function store(ReferensiRequest $request)
    {
        $item = new Referensi();
        $item->jml_penduduk = $request->jml_penduduk;
        $item->luas_desa = $request->luas_desa;
        $item->jarak_kecamatan = $request->jarak_kecamatan;
        $item->save();

        return redirect()->route('referensi.index');
    }

    public function edit($id)
    {
        $item = Referensi::findOrFail($id);

        return view('pages.admin.referensi.edit', [
            'item' => $item
        ]);
    }

    public function update(ReferensiRequest $request, $id)
    {
        $item = Referensi::findOrFail($id);
        $item->jml_penduduk = $request->jml_penduduk;
        $item->luas_desa = $request->luas_desa;
        $item->jarak_kecamatan = $request->jarak_kecamatan;
        $item->save();

        return redirect()->route('referensi.index');
    }

    public function serba_serbi_index()
    {
        $items = SerbaSerbi::all();

        return view('pages.admin.serba-serbi.index', [
            'items' => $items
        ]);
    }

    public function serba_serbi_create()
    {
        return view('pages.admin.serba-serbi.create');
    }

    public function serba_serbi_store(SerbaSerbiRequest $request)
    {
        $item = new SerbaSerbi();
        $item->serba_serbi = $request->serba_serbi;
        $item->save();

        return redirect()->route('serba-serbi.index');
    }

    public function serba_serbi_edit($id)
    {
        $item = SerbaSerbi::findOrFail($id);

        return view('pages.admin.serba-serbi.edit', [
            'item' => $item
        ]);
    }

    public function serba_serbi_update(SerbaSerbiRequest $request, $id)
    {
        $item = SerbaSerbi::findOrFail($id);
        $item->serba_serbi = $request->serba_serbi;
        $item->save();

        return redirect()->route('serba-serbi.index');
    }
}
