<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemesanan extends Model
{
    use HasFactory;
    protected $table = 'pemesanan';
    protected $primary_key = 'id';
    protected $fillable = [
        'nama_pemesan',
        'nama_tamu',
        'email',
        'no_hp',
        'jumlah_kamar_dipesan',
        'kamar_id',
        'tanggal_checkin',
        'tanggal_checkout',
        'tanggal_dipesan',
        'status_pemesan'
    ];
    public function kamar() {
        return $this->belongsTo(kamar::class, 'kamar_id', 'id');
    }
}
