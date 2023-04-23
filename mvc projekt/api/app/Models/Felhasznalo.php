<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Felhasznalo extends Model
{
    use HasFactory;

    protected $table = 'felhasznalok';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'vezeteknev',
        'keresztnev',
        'szuletesi_datum',
        'email',
        'jelszo_hash',
        'nem',
        'profilkep',
        'hirelevelezes',
        'gdpr_elfogadva',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'jelszo_hash',
        'created_at',
        'updated_at',
    ];
}
