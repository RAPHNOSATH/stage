<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeEquipe extends Model
{
    use HasFactory;
    protected $fillable=[
        'nom_type'
    ];
    public function equipes():HasMany
    {
        return $this->hasMany(Equipe::class);
    }
}
