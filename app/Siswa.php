<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    use Notifiable;
    protected $table = "students";
    protected $guarded = 'siswa';
    protected $primaryKey = 'id';

    protected $fillable = ['nama', 'nisn', 'password', 'kelas', 'jurusan'];

    public function votes()
    {
        return $this->belongsTo('App\Votes', 'student_id', 'id');
    }
}
