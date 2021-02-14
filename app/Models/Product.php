<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function categories() {
        return $this->belongsToMany('App\Models\Category');
    }

    public function presentPrice() {
        return '£'.number_format($this->price / 100, 2, '.', '');
    }
}
