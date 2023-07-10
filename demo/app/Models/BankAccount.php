<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bank_account';

    /** @var array<string> */
    protected $fillable = [
        'id',
        'user_id',
        'value_by_count',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
