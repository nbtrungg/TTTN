<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='users';
    protected $fillable=[
        'name',
        'avatar',
        'phone',
        'email',
        'status',
        'address',
        'password',
        'roll',
    ];
}
