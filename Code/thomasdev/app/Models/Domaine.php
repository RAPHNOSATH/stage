<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Domaine extends Model
{
    use HasFactory;

    protected $fillable=[
        'nom_d'
    ];

    public function sous_domaines(): HasMany
    {
        return $this->hasMany(SousDomaine::class);
    }
}
