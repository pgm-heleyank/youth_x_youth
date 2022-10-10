<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Allergen extends Model
{
    protected $table = 'allergens';

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function meals()
    {
        return $this->belongsToMany(Meal::class);
    }
}
