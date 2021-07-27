<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calon;
use Validator;

class CalonController extends Controller
{
    public function index()
    {
        $calon = Calon::all();
        return view('admin.dashboard.menu.calon', compact('calon'));
    }

    public function deleteall()
    {
        Calon::wherenotNull('id')->delete();
        return redirect()->back();
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'nisn' => 'required|max:12',
                'nama' => 'required|string',
                'visi' => 'required|string',
                'misi' => 'required|string',

            ]
        );

        $calon = new Calon;

        if ($request->file('file')) {
            $imagePath = $request->file('file');
            $imageName = $imagePath->getClientOriginalName();

            $path = $request->file('file')->storeAs('uploads', $imageName, 'public');
        }
        $calon->nama = $request->nama;
        $calon->nisn = $request->nisn;
        $calon->kelas = $request->kelas;
        $calon->jurusan = $request->jurusan;
        $calon->gambar = '/storage/' . $path;
        $calon->visi = $request->visi;
        $calon->misi = $request->misi;
        $calon->save();

        return response()->json('Image uploaded successfully');
    }


    public function delete($id)
    {
        Calon::find($id)->delete($id);
        return response()->json(['success' => 'Data berhasil di hapus']);
    }
}
