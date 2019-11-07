<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserType extends Model
{
    const ADMIN = 1;
    const PROJECT_MANAGER = 2;
    const DEVELOPER = 3;

    protected $table = 'user_types';

    protected $fillable = ['key', 'name'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'type_id');
    }
}
