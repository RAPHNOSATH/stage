<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Annonce extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable=[
        'title',
        'content',
        'file'
    ];

    public function filetUrl():string
    {
        return Storage::url($this->file);
    }
}
