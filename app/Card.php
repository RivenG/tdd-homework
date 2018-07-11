<?php

namespace Homework;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'account_id',
        'customer_id',
        'number'
    ];
    public function customer()
    {
        $this->hasOne(Customer::class);
    }
}
