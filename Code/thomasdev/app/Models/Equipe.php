<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Equipe extends Model implements LaratrustUser
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRolesAndPermissions;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable=[
        'nom_equipe',
        'effectif',
        'effectif_min',
        'document_equipe',
        'email_equipe',
        'statut_equipe',
        'statut_delai',
        'delai',
        'date_start',
        'number_day',
        'number_day_rest',
        'type_equipe_id'
    ];

    public function membres():HasMany
    {
        return $this->hasMany(Membre::class);
    }
    public function projets():HasMany
    {
        return $this->hasMany(Projet::class);
    }

    public function type_equipe():BelongsTo
    {
        return $this->belongsTo(TypeEquipe::class);
    }
    public function documentUrl():string
    {
        $appUrl = env('APP_URL');
        $urlFichier= Storage::url($this->document_equipe);
        return $appUrl .$urlFichier;
    }
}
