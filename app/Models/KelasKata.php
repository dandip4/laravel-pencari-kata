<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasKata extends Model
{
    use HasFactory;
    protected $table = 'kelas_katas';
    protected $fillable = ['nama'];

    public function katas()
    {
        return $this->hasMany(Kata::class);
    }
}
