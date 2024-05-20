<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kata extends Model
{
    use HasFactory;
    protected $fillable = ['kata', 'kelas_kata_id'];

    public function kelasKata()
    {
        return $this->belongsTo(KelasKata::class);
    }

    public function sinonims()
    {
        return $this->belongsToMany(Kata::class, 'sinonims', 'kata_id', 'sinonim_id');
    }

    public function antonims()
    {
        return $this->belongsToMany(Kata::class, 'antonims', 'kata_id', 'antonim_id');
    }

    public function imbuhans()
    {
        return $this->hasMany(Imbuhan::class);
    }
}
