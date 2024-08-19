<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanduanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('panduan.index', [
            'users' => $user
        ]);
    }
}
