<?php

namespace App\Http\Controllers;

use App\Models\JadwalSesi;
use App\Models\Pendaftaran;
use App\Models\StudyCase;
use App\Models\User;
use App\Models\Wawancara;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $metrics = [
            'candidates' => User::where('Role', 'user')->count(),
            'applications' => Pendaftaran::count(),
            'study_cases' => StudyCase::count(),
            'interviews' => Wawancara::count(),
        ];

        $pipeline = [
            'Menunggu review' => Pendaftaran::where('StatusBerkas', 'Menunggu')->count(),
            'Lolos berkas' => Pendaftaran::where('StatusBerkas', 'Lolos')->count(),
            'Selesai' => Pendaftaran::where('StatusAkhir', 'Lolos')->count(),
        ];

        $recentApplications = Pendaftaran::with('user')
            ->latest('created_at')
            ->limit(6)
            ->get();

        $nextSession = JadwalSesi::where('IsActive', true)
            ->orderBy('TanggalSesi')
            ->orderBy('WaktuMulai')
            ->first();

        return view('admin.home', compact('metrics', 'pipeline', 'recentApplications', 'nextSession'));
    }
}