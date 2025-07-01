<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'banner',
        'terms_and_conditions',
        'moreDetails',
    ];

    protected $casts = [
        'moreDetails' => 'array',
    ];

    public function getConfig($key, $default = null)
    {
        return $this->moreDetails[$key] ?? $default;
    }

    public function getBasedPriceAttribute()
    {
        $details = $this->moreDetails ?? [];
        if (isset($details['price'])) {
            return $details['price'];
        } else if (isset($details['packageOptions'][0]['price'])) {
            return $details['packageOptions'][0]['price'];
        } else if (isset($details['locationOptions'][0]['price'])) {
            return $details['locationOptions'][0]['price'];
        } else {
            return 0;
        }
    }
}
