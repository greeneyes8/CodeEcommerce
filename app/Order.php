<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model {
    protected $fillable = [
        'user_id',
        'total',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(\CodeCommerce\OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(\CodeCommerce\User::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeIsOwner($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }
}
