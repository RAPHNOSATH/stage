<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Communique extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable=[
        'document_c'
    ];

    public function documentUrl():string
    {
        $urlFichier= Storage::url($this->document_c);
        return $urlFichier;
    }
}
