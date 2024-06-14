<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Projet extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'projets';
    protected $fillable=[
        'intitule_projet',
        'description_projet',
        'document_descriptif',
        'en_recherche',
        'est_accepte',
        'sous_domaine_id',
        'user_id',
        'equipe_id'
    ];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function sous_domaine():BelongsTo
    {
        return $this->belongsTo(SousDomaine::class);
    }
    public function equipe():BelongsTo
    {
        return $this->belongsTo(Equipe::class);
    }
    public function documentUrl():string
    {
        return Storage:: url($this->document_descriptif);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'commentaires', 'projet_id')->withPivot('commentaire', 'nombre_c')->withTimestamps();
    }
    public function membres(): BelongsToMany
    {
        return $this->belongsToMany(Membre::class, 'commentaires', 'projet_id')->withPivot('commentaire', 'nombre_c')->withTimestamps();
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }
}
