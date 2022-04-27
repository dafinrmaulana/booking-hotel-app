<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kamar extends Model
{
    use HasFactory;
    protected $table = 'kamar';
    protected $guarded = [];

    public function fasilitas() {
        return $this->belongsToMany(fasilitasKamar::class, 'fasilitas_kamar_store', 'kamar_id', 'fasilitasKamar_id')->withTimestamps();
    }

}
