<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name','domain'];

    protected function name():Attribute
    {
        return Attribute::make(
            set:fn(string $name)=>Str::title($name)
        );
    }
}
