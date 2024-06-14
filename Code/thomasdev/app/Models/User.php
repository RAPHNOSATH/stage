<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;

class User extends Authenticatable implements LaratrustUser
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'nom',
        'prenom',
        'pays',
        'intitule',
        'description',
        'domaine',
        'specialite',
        'titre_academique',
        'service',
        'matricule',
        'filiere',
        'niveau',
        'option',
        'universite',
        'adresse',
        'email',
        'telephone',
        'password',
        'is_active',
        'is_staff',
        'is_superuser',
        'document',
        'cv',
        'contrat',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
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

    public function documentUrl():string
    {
        return Storage:: url($this->document);
    }
    public function cvUrl():string
    {
        return Storage:: url($this->cv);
    }
    public function contratUrl():string
    {
        return Storage:: url($this->contrat);
    }
    public function imageUrl():string
    {
        return Storage:: url($this->image);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Projet::class);
    }
    public function projets(): BelongsToMany
    {
        return $this->belongsToMany(Projet::class, 'commentaires', 'user_id')->withPivot('commentaire', 'nombre_c')->withTimestamps();
    }

    public function resultats(): BelongsToMany
    {
        return $this->belongsToMany(Resultat::class,'notes','user_id')->withPivot('note', 'mention','remarque')->withTimestamps();
    }
}
