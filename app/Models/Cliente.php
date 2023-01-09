<?php

namespace App\Models;

use App\Traits\IdentifierFields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes, IdentifierFields;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'telefone',
        'nome',
        'como_soube_id',
        'cpf',
        'cep',
        'rua',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'viabilidade',
        'observacao'
    ];
}
