<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antonim extends Model
{
    use HasFactory;
    protected $fillable = ['kata_id', 'antonim_id'];

    public function kata()
    {
        return $this->belongsTo(Kata::class, 'kata_id');
    }

    public function antonim()
    {
        return $this->belongsTo(Kata::class, 'antonim_id');
    }
}
