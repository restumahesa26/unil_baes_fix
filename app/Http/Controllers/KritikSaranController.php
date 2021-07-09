<?php

namespace App\Http\Controllers;

use App\Models\KritikSaran;
use Illuminate\Http\Request;

class KritikSaranController extends Controller
{
    public function index()
    {
        $items = KritikSaran::all();
        return view('pages.admin.kritik-saran.index', [
            'items' => $items
        ]);
    }

    public function destroy($id)
    {
        $item = KritikSaran::findOrFail($id);
        $item->delete();

        return redirect()->route('kritik-saran.index');
    }
}
