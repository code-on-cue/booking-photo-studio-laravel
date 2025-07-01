<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $table = 'configs';
    protected $fillable = [
        'appName',
        // 'price',
        // 'additionalPrice',
        // 'maximumPerson',
        // 'openStore',
        // 'closeStore',
        // 'breakTime',
        // 'duration',
        'accountSource',
        'accountNumber',
        'accountHolder',
        'whatsapp',
        'instagram',
        'address',
        'map',
    ];
}
