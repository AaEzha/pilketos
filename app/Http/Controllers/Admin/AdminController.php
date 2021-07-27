<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Siswa;
use App\Votes;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function form_login()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $rememberme = $request->rememberme ? true : false;
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password], $rememberme)) {
            return response()->json([
                'success' => true
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Login Gagal'
            ], 401);
        }
    }

    public function dashboard()
    {
        $siswa = Siswa::count();
        $sSudahMemilih = Votes::count();
        // dd($sSudahMemilih);

        return view('admin.dashboard.dashboard', compact('siswa', 'sSudahMemilih'));
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
