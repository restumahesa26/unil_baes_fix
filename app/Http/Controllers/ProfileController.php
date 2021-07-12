<?php

namespace App\Http\Controllers;

use App\Models\EmailSubscribe;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $items = User::orderBy('roles', 'ASC')->get();
        $email = EmailSubscribe::all();

        return view('pages.admin.profile.index', [
            'items' => $items, 'emails' => $email
        ]);
    }

    public function setAdmin($id)
    {
        $item = User::findOrFail($id);
        $item->roles = 'ADMIN';
        $item->save();

        return redirect()->route('profile.index');
    }

    public function setUser($id)
    {
        $item = User::findOrFail($id);
        $item->roles = 'USER';
        $item->save();

        return redirect()->route('profile.index');
    }

    public function deleteUserAdmin($id)
    {
        $item = User::findOrFail($id);
        $item->delete();

        return redirect()->route('profile.index');
    }

    public function deleteEmail($id)
    {
        $item = EmailSubscribe::findOrFail($id);
        $item->delete();

        return redirect()->route('profile.index');
    }
}
