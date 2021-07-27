<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Siswa;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::select('nisn', 'nama', 'kelas', 'jurusan')->get();

        return view('admin.dashboard.menu.siswa', compact('siswa'));
    }

    public function store(Request $request)
    {
        // $request->all();
        $siswa =   Siswa::create([
            'id' => $request->id,
            'nama' => $request->nama,
            'nisn' => $request->nisn,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'password' => bcrypt($request->password)
        ]);

        return response()->json($siswa);
    }
}
