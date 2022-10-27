<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class School extends Model
{
    protected $table = 'schools';
    public function campuses()
    {
        return $this->hasMany(Campuse::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
