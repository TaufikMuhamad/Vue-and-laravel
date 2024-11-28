<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $fillable = ['full_name', 'email', 'degree', 'hobi_id'];

    public function hobi()
    {
        return $this->belongsTo(Hobi::class, 'hobi_id', 'id');
    }
}
