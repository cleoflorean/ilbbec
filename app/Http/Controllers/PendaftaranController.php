<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function CreatePendaftaran(Request $request){

        $request->validate([
            'UserId' => 'required|integer|max:255',
            'Divisi' => 'required|string|max:255',
            'BerkasCV' => 'required|file|mimes:pdf|max:2048',
            'Portofolio' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $BerkasCVPath = $request->file('BerkasCV')->store('BerkasCV', 'public');
        $portofolioPath = $request->hasFile('Portofolio') ? $request->file('Portofolio')->store('portofolio', 'public') : null;

        // Simpan data pendaftaran ke database
        Pendaftaran::create([
            'UserId' => $request->UserId,
            'Divisi' => $request->Divisi,
            'BerkasCV' => $BerkasCVPath,
            'Portofolio' => $portofolioPath,
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil dikirim!');
    }
}
