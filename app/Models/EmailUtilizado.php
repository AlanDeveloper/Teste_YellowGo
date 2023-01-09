<?php

namespace App\Models;

use App\Traits\IdentifierFields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailUtilizado extends Model
{
    use HasFactory, SoftDeletes, IdentifierFields;

    protected $table = 'emails_utilizados';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
    ];
}
