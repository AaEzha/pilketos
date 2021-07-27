<?php

namespace App\Exports;

use App\Votes;
use App\Calon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;



class VotesExport implements FromQuery
{


    use Exportable;
    // public $year
    protected $year;
    public function __construct($year)
    {

        $this->year = $year;
        return $this;
    }

    public function query()
    {
        return Calon::query()->whereYear('tahun', '=', $this->year);
    }
}
