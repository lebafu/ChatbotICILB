<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nlu_name extends Model
{
    use HasFactory;

    protected $table = 'nlu_name';
    protected $primarykey = 'id';
    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;
}
