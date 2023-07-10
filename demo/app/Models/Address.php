<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'address';

    /** @var array<string> */
    protected $fillable = [
        'id',
        'user_id',
        'cep',
        'street',
        'complement',
        'neighborhood',
        'number',
        'locality',
        'uf',
        'ibge',
        'gia',
        'ddd',
        'siafi',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
