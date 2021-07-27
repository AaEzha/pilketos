<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Calon;
use App\Siswa;
use Illuminate\Support\Facades\DB;
use App\Votes;

class SiswaController extends Controller
{
    public function index()
    {
        $calon = Calon::limit(3)->get();


        if (empty(Auth::guard('siswa')->check())) {
            return view('siswa.index');
        } else {
            $calonId = DB::select("SELECT candidate_id FROM votes WHERE student_id = " .  Auth::guard('siswa')->user()->id   . "")[0];
            // return view('siswa.index', compact('calon'));
        }


        $empt = "";
        foreach ($calonId as $id) {
            $empt = $id;
        }
        $thanks = DB::select("SELECT * FROM candidates WHERE id = " . $empt . "");
        // dd($thanks);
        if (DB::select("SELECT * from votes where student_id = " . 1 . "")) {
            return view('siswa.thanks', compact('thanks'));
        } else {
            return view('siswa.index', compact('calon', 'calonId'));
        }
    }

    public function login(Request $request)
    {
        $Nisn = $request->input('nisn');
        $Password = $request->input('password');
        // $id =  Auth::guard('siswa')->user()->id;
        // $bloked = Votes::where('student_id' == Auth::guard('siswa')->user()->id)->first();

        // $votes = Siswa::where(['nisn' => $Nisn, 'password' => $Password])->get('id');
        // // dd($votes);
        // $id = DB::select("SELECT id FROM students WHERE nisn = '$Nisn' AND password = '$Password'");
        // echo bcrypt($Password);
        // var_dump($votes);

        if (Auth::guard('siswa')->attempt(['nisn' => $Nisn, 'password' => $Password])) {
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


    public function voting(Request $request)
    {
        $siswa = Auth::guard('siswa')->user()->id;


        $data = [
            'candidate_id' => $request->candidat_id,
            'student_id' => $siswa,
            'votes' => $request->votes,
        ];

        if ($siswa) {
            Votes::insert($data);
            // Auth::guard('siswa')->logout();
            return response()->json(['success' => true], 200);
        }




        // if ($siswa) {

        //     Auth::guard('siswa')->logout();


        //
    }

    public function logout()
    {
        Auth::guard('siswa')->logout();
        return view('siswa.index');
    }
}
