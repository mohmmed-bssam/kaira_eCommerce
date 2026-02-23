<?php

namespace App\Traits;

trait Trans
{
    public function getTitleTransAttribute()
    {
        return $this->title[app()->getLocale()];
    }
    public function getdescriptionTransAttribute()
    {
        return $this->description[app()->getLocale()];
    }
}
