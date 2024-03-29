<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends CachedModel
{
    protected $fillable = ['title', 'details', 'subtitle'];
    public $timestamps = false;
}
