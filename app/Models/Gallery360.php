<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery360 extends CachedModel
{
    protected $fillable = ['product_id','photo'];
    public $timestamps = false;

    protected $table = 'galleries360';

}
