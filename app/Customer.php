<?php

namespace Homework;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['firstname', 'lastname'];

    public function account()
    {
        $this->hasOne(Account::class);
    }
}
