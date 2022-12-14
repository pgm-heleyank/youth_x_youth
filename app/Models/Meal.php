<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Meal extends Model
{
    protected $table = 'meals';
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function allergens()
    {
        return $this->belongsToMany(Allergen::class);
    }
    public function campuses()
    {
        return $this->belongsTo(Campuse::class);
    }
    public function orders()
    {
        return $this->hasOne(Order::class);
    }
}
