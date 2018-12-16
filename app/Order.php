<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function paymentStatus()
    {
        return $this->hasOne('App\PaymentStatus');
    }
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function account()
    {
        return $this->belongsTo('App\Account');
    }
}
