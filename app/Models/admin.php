<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD

class admin extends Model
{
    use HasFactory;
    protected $table = 'admin';
    protected $fillable = ['nama', 'username','password','remember_token'];
    protected $rules = ['nama'=>'required|min:4|Max:50|not_regex:/[0-9!@#$%^&*()_+=]/|unique:admin,nama'];
=======
use Illuminate\Foundation\Auth\User as Authenticatable;

class admin extends Authenticatable
{
    use HasFactory;
    protected $table = 'admin';
    protected $fillable = ['nama','role', 'username', 'password', 'remember_token'];
>>>>>>> 7782819007e372ce748b0bdd092c628d1a01019d
}
