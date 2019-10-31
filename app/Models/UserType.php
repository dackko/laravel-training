<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserType extends Model
{
    protected $table = 'user_types';

    protected $fillable = ['key', 'name'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'type_id');
    }
}
