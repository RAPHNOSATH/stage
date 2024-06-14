<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable=[
        'message',
        'is_private',
        'membre_id'
    ];

    public function membre()
    {
        return $this->belongsTo(Membre::class,'membre_id');
    }

}
