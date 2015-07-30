<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model {

    protected $fillable = ['name'];

    public function orders()
    {
        return $this->hasMany(\CodeCommerce\Order::class);
    }
}