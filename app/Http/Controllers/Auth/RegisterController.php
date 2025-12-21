<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function register(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8',
        ]);

        $validatedData['password'] = Hash::make($request->password);
        $validatedData['role'] = 'volunteer';
        $validatedData['expired_member'] = now()->addDays(14)->format('Y-m-d H:i:s');

        User::create($validatedData);

        return redirect('/login')->with('success', 'Register berhasil!');
    }
}
