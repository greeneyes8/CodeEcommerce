<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    protected $fillable = [
        'name'
    ];

    public function products()
    {
        return $this->belongsToMany(\CodeCommerce\Product::class);
    }

    public static function findByName($value)
    {
        return Tag::where('name', trim($value));
    }
}
