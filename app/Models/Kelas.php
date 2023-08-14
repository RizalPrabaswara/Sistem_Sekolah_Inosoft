<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as model;


class Kelas extends model
{
    use HasFactory;

    protected $guarded = ['_id'];
}
