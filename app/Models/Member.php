<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    protected $fillable = ['name', 'email', 'status'];

    public function surat(): HasMany
    {
        return $this->hasMany(Surat::class, 'member_id');
    }
}
