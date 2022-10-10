<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Mealbox extends Model
{
    protected $table = 'mealboxes';
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
