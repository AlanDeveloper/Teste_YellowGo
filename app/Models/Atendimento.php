<?php

namespace App\Models;

use App\Traits\IdentifierFields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Atendimento extends Model
{
    use HasFactory, SoftDeletes, IdentifierFields;

    protected $fillable = [
        'status',
        'responsavel_id',
        'cliente_id',
    ];
}
