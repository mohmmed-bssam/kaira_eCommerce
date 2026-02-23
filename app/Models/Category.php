<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Trans;
    protected $guarded = [];
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    protected function casts(): array
    {
        return [
            'title' => 'array',
        ];
    }

}
