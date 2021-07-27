<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calon extends Model
{
    protected $table = "candidates";
    protected $primaryKey = 'id';
    // protected $guarded = 'kandidat';
    protected $fillable = ['nama', 'nisn', 'gambar', 'kelas', 'jurusan', 'created_at'];
}
