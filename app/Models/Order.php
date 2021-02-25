<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'billing_email', 'billing_name', 'billing_address', 'billing_city',
        'billing_county', 'billing_postcode', 'billing_phone', 'billing_name_on_card',
        'billing_total', 'error'
    ];

    //Order belongs to ONE user
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    //Many to Many with Products
    public function products() {
        return $this->belongsToMany('App\Models\Product')->withPivot('quantity');
    }
}
