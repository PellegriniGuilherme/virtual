<?php

namespace App\Models;

use App\Casts\CpfCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf',
        'email'
    ];

    protected $casts = [
        'id' => 'integer',
        'nome' => 'string',
        'cpf' => CpfCast::class,
        'email' => 'string'
    ];
}
