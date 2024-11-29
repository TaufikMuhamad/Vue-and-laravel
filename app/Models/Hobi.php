<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobi extends Model
{
    use HasFactory;
    protected $table = 'hobi';
    protected $fillable = ['name'];

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'hobi_siswa', 'hobi_id', 'siswa_id');
    }
}
