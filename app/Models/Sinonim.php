<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sinonim extends Model
{
    use HasFactory;

    protected $fillable = ['kata_id', 'sinonim_id'];

    public function kata()
    {
        return $this->belongsTo(Kata::class, 'kata_id');
    }

    public function sinonim()
    {
        return $this->belongsTo(Kata::class, 'sinonim_id');
    }
}
