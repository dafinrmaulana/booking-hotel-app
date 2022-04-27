<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemesanan extends Model
{
    use HasFactory;
    protected $table = 'pemesanan';
    protected $primary_key = 'id';
    protected $guarded = [];
    public function kamar() {
        return $this->belongsTo(kamar::class, 'kamar_id', 'id');
    }
}
