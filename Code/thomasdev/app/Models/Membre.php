<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;

class Membre extends Authenticatable implements LaratrustUser
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRolesAndPermissions;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable=[
        'nom_m',
        'prenom_m',
        'profession_m',
        'cv_m',
        'password',
        'equipe_id',
        'is_staff',
        'is_superuser',
        'email',
        'is_expert',
        'statut_membre',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function equipe():BelongsTo
    {
        return $this->belongsTo(Equipe::class);
    }
    public function resultats(): BelongsToMany
    {
        return $this->belongsToMany(Resultat::class,'notes','membre_id')->withPivot('note', 'mention','remarque')->withTimestamps();
    }
    public function projets(): BelongsToMany
    {
        return $this->belongsToMany(Projet::class, 'commentaires', 'membre_id')->withPivot('commentaire', 'nombre_c')->withTimestamps();
    }


    public function  messages():HasMany{
        return $this->hasMany(Message::class);
    }
}
