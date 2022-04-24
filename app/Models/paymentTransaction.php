<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paymentTransaction extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function pemesanan() {
        return $this->belongsTo(pemesanan::class, 'pemesanan_id', 'id');
    }
}
