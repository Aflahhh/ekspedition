<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        $this->authorize('IsAdmin');
        return view('dashboard.image.index');
    }
}
