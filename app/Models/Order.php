<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $table = 'orders';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function mealbox()
    {
        return $this->belongsTo(Mealbox::class);
    }
    public function campuses()
    {
        return $this->belongsTo(Campuse::class);
    }
}
