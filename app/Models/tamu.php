<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tamu extends Model
{
    use HasFactory;
    protected $table = 'tamu';
    protected $primary_key = 'id';
    protected $fillable = ['nama','username','email','password','no_hp','remember_token'];
}
