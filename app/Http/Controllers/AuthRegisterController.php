<?php

namespace App\Http\Controllers;
use App\Models\Prodi;
use Illuminate\Http\Request;

class AuthRegisterController extends Controller
{
    public function create()
    {
        $prodis = Prodi::all();
        return view 
    }


}
