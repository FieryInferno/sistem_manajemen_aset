<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asets extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    public function pengadaan()
    {
      return $this->belongsTo(Pengadaan::class);
    }
}
