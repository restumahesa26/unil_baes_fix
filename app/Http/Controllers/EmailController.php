<?php

namespace App\Http\Controllers;

use App\Mail\KirimEmail;
use App\Models\EmailSubscribe;
use App\Models\Informasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function emailInformasi($id)
    {
        $informasi = Informasi::findOrFail($id);

        $data = new \stdClass();
        $data->informasi = $informasi;

        $email = EmailSubscribe::all();

        foreach ($email as $value) {
            Mail::to($value->email)->send(new KirimEmail($data));
        }

        return redirect()->route('informasi.index');
    }
}
