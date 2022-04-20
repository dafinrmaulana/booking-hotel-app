<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    use HasFactory;
    protected $table = 'admin';
    protected $fillable = ['nama', 'username','password','remember_token'];
    protected $rules = ['nama'=>'required|min:4|Max:50|not_regex:/[0-9!@#$%^&*()_+=]/|unique:admin,nama'];
}
