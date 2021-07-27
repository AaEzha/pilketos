<?php

namespace App\Http\Controllers\Admin;

use App\Calon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VotesExport;
use App\Votes;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{



    public function index()
    {


        $calon = Calon::LeftJoin('votes', 'votes.candidate_id', '=', 'candidates.id')
            ->select(
                'candidates.nama',
                'candidates.kelas',
                'candidates.jurusan',
                'votes.votes',
                DB::raw('YEAR(candidates.created_at) as Tahun')
            )->get();
        // // dd($calon);



        return view('admin.dashboard.menu.laporan', compact('calon'));
    }


    public function findyear(Request $request)
    {
        // $cari = $request->cari_data;


        if ($year = $request->year) {

            return redirect()->back();
        }

        $calon = DB::select('SELECT candidates.nama,candidates.kelas,candidates.jurusan,votes.votes,
        YEAR(candidates.created_at) as Tahun FROM candidates LEFT JOIN votes ON candidates.id = votes.candidate_id
        WHERE YEAR(candidates.created_at) = ' . $year . '');
        // dd($calon);
        // return Excel::download(new VotesExport($request->year), 'calon.xlsx');

        return view('admin.dashboard.menu.laporan', compact('calon'));
    }

    public function excel(Request $request, $year)
    {



        return (new VotesExport($year))->download('asd.xlsx');
    }
}
