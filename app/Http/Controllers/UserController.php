<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Armada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{

    public function showTotalUsers()
    {
        $totalUsers = User::count();
        return view('dashboard.index', compact('totalUsers'));
    }
}
