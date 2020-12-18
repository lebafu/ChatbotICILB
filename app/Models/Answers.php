<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    use HasFactory;

    protected $table = 'answers';
    protected $primarykey = 'id';
    protected $fillable = [
        'nombre',
        'id_questions',
        'ruta_archivo'
    ];

    public $timestamps = false;
}
