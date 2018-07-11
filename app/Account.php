<?php

namespace Homework;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'customer_id',
        'number'
    ];
    public function cards()
    {
        $this->hasMany(Card::class);
    }

    public function customers()
    {
        $this->hasOne(Customer::class);
    }
}
