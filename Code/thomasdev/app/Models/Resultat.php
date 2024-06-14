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

class Resultat extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable=[
        'rapport',
        'business_model',
        'autre_document',
        'is_public',
        'is_valid',
        'etat',
        'is_rapport_valid',
        'is_business_valid',
        'is_document_valid',
        'is_visite_terrain_valid',
        'equipe_id',
    ];
    public function membres(): BelongsToMany
    {
        return $this->belongsToMany(Membre::class,'notes','resultat_id')->withPivot('note', 'mention','remarque')->withTimestamps();
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'notes','resultat_id')->withPivot('note', 'mention','remarque')->withTimestamps();
    }
    public function rapportUrl():string
    {
        $appUrl = env('APP_URL');
        $urlFichier = Storage::url($this->rapport);
        return $appUrl .$urlFichier;
    }
    public function businessUrl():string
    {
        $appUrl = env('APP_URL');
        $urlFichier = Storage::url($this->business_model);
        return $appUrl .$urlFichier;
    }
    public function documentUrl():string
    {
        $appUrl = env('APP_URL');
        $urlFichier = Storage::url($this->autre_document);
        return $appUrl .$urlFichier;
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
