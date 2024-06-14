<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laratrust\Models\Role as RoleModel;

class Role extends RoleModel
{
    use HasFactory,HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $guarded = [];

    public function membre():BelongsTo{
        return $this->belongsTo(Membre::class,'membre_id');
    }

}
