<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    protected $table = "votes";
    protected $fillable = ['candidate_id', 'student_id', 'votes'];


    public function Siswas()
    {
        return $this->belongsTo('App\Siswa', 'student_id', 'id');
    }
}
