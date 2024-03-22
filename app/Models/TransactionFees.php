<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionFees extends Model
{
    use HasFactory;

    protected $table = 'tbl_transaction_fees';
    public $timestamps = false;
    protected $fillable = [
        'min_amt',
        'max_amt',
        'rates',
    ];
}
