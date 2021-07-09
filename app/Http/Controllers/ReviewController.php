<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $items = Review::all();

        return view('pages.admin.review.index', [
            'items' => $items
        ]);
    }

    public function buat_aktif($id)
    {
        $item = Review::findOrFail($id);
        $item->active = 0;
        $item->save();

        return redirect()->route('review.index');
    }

    public function buat_tidak_aktif($id)
    {
        $item = Review::findOrFail($id);
        $item->active = 1;
        $item->save();

        return redirect()->route('review.index');
    }

    public function destroy($id)
    {
        $item = Review::findOrFail($id);
        $item->delete();

        return redirect()->route('review.index');
    }
}
