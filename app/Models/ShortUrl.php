<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShortUrl extends Model
{
    use HasFactory;
    protected $fillable =['user_id','company_id','original_url','short_code','clicks'];

    /**
     * Get the user that owns the ShortUrl
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company():BelongsTo{
        return $this->belongsTo(Company::class);
    }
}
