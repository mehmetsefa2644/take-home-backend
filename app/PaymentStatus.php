<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
