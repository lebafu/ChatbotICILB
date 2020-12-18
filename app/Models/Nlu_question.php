<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nlu_question extends Model
{
    use HasFactory;

    protected $table = 'nlu_questions';
    protected $primarykey = 'id';
    protected $fillable = [
        'respuestas',
        'nlu_name_id'
    ];

    public $timestamps = false;
}
