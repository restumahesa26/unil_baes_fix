<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    public function index()
    {
        return view('pages.admin.qr-code.index');
    }
}
