<?php

namespace App\Models;

use App\Helpers\StrHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    const STATUS_PENDING = 'pending';
    const STATUS_PROCESS = 'process';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';

    protected $fillable = [
        'trxId',
        'name',
        'phone',
        'numberOfPerson',
        'date',
        'time',
        'basedPrice',
        'basedPerson',
        'additionalPrice',
        'totalPrice',
        'downPayment',
        'linkDrive',
        'status',
    ];

    public function currency($column)
    {
        $arrayList = ['downPayment', 'basedPrice', 'additionalPrice', 'totalPrice'];

        if (in_array($column, $arrayList)) return StrHelper::currency($this->{$column});

        return "-";
    }

    public function getColorStatusAttribute()
    {
        switch ($this->status) {
            case self::STATUS_FAILED:
                return 'bg-danger';
            case self::STATUS_PENDING:
                return 'bg-warning';
            case self::STATUS_PROCESS:
                return 'bg-success';
            case self::STATUS_SUCCESS:
                return 'bg-success';
        }
    }
}
