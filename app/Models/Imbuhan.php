<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imbuhan extends Model
{
    use HasFactory;
    protected $fillable = ['imbuhan', 'kata_id'];

    public function kata()
    {
        return $this->belongsTo(Kata::class, 'kata_id');
    }
}
