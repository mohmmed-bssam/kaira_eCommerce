<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product_collection extends Model
{
    //
    protected $guarded = [];
    public function collections()
    {
        return $this->belongsToMany(Collection::class);
    }
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
 

}