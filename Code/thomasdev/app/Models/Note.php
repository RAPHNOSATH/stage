<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Note extends Pivot
{
    protected $table = 'notes';
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
    protected $fillable=[

        'note',
        'mention',
        'remarque',
        'resultat_id',
        'membre_id',
        'user_id'
    ];


    public function resultat()
    {
        return $this->belongsTo(Resultat::class);
    }
    public function membre():BelongsTo
    {
        return $this->belongsTo(Membre::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
