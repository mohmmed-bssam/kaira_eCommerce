<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use Trans;
    //
    protected $guarded = [];
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    protected function casts(): array {
        return [
            'title' => 'array',
            'description' => 'array',
        ];
    }
}
