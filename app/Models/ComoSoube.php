<?php

namespace App\Models;

use App\Traits\IdentifierFields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComoSoube extends Model
{
    use HasFactory, SoftDeletes, IdentifierFields;

    protected $table = 'como_soube';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titulo',
        'descricao',
    ];
}
