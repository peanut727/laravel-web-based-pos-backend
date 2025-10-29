<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'cashier_name',
        'payment_method',
        'subtotal',
        'tax',
        'total',
        'timestamp',
    ];

    public function items()
    {
        return $this->hasMany(TransactionItems::class);
    }
}
