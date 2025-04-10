<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    protected $fillable =['user_id','company_id','original_url','short_code','clicks'];
}
