<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $fillable = ['full_name', 'email', 'degree'];

    public function hobi()
    {
        return $this->belongsToMany(Hobi::class, 'hobi_siswa', 'siswa_id', 'hobi_id');
    }
}
