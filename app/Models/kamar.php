<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use App\Models\fasilitasKamarStore;
=======
>>>>>>> 7782819007e372ce748b0bdd092c628d1a01019d

class kamar extends Model
{
    use HasFactory;
    protected $table = 'kamar';
    protected $fillable = ['nama_kamar', 'jumlah', 'harga', 'foto', 'keterangan'];

    public function fasilitas() {
        return $this->belongsToMany(fasilitasKamar::class, 'fasilitas_kamar_store', 'kamar_id', 'fasilitasKamar_id')->withTimestamps();
    }

}
