<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JogiDokumentum extends Model
{
    use HasFactory;

    protected $table = 'jogi_dokumentumok';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'utvonal',
        'nev',
        'leiras',
    ];
}
