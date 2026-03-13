<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Trans;
    protected $guarded = [];
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    protected function casts(): array
    {
        return [
            'title' => 'array',
            'content' => 'array',
        ];
    }
}