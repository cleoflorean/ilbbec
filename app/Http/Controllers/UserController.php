<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        $hasPendaftaran = $user->pendaftaran()->exists();

        return view('user.home', compact('user', 'hasPendaftaran'));
    }
}
