<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Commentaire extends Pivot
{
    protected $table = 'commentaires';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $fillable=[
        'commentaire',
        'nombre_c',
    ];

    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }

    /**
     * Récupère l'utilisateur associé à ce commentaire.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function membre()
    {
        return $this->belongsTo(Membre::class);
    }
}
