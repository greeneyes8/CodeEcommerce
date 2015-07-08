<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $fillable = ['category_id', 'name', 'description', 'price', 'featured', 'recommend'];

    public function images()
    {
        return $this->hasMany(\CodeCommerce\ProductImage::class);
    }

    public function category()
    {
        return $this->belongsTo(\CodeCommerce\Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(\CodeCommerce\Tag::class);
    }

    public function getTagListAttribute()
    {
        $tags = $this->tags->lists('name')->toArray();

        return implode(',', $tags);
    }
}