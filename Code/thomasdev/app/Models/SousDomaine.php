<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SousDomaine extends Model
{
    use HasFactory;
    protected $fillable=[
        'nom_s',
        'domaine_id'
    ];

    public function domaine():BelongsTo
    {
        return $this->belongsTo(Domaine::class);
    }

    public function projets(): HasMany
    {
        return $this->hasMany(Projet::class);
    }

}
