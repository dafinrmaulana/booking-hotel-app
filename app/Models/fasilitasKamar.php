<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fasilitasKamar extends Model
{
    use HasFactory;
    protected $table = 'fasilitas_kamar';
    protected $fillable = ['nama_fasilitas','keterangan'];
}
