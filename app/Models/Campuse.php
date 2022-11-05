<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Campuse extends Model
{
    protected $table = 'campuses';

    public function schools()
    {
        return $this->belongsTo(School::class);
    }
    public function meals()
    {
        return $this->hasMany(Meal::class);
    }
}
