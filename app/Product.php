<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $fillable = ['category_id', 'name', 'description', 'price', 'featured', 'recommend'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(\CodeCommerce\ProductImage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(\CodeCommerce\Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(\CodeCommerce\Tag::class);
    }

    /**
     * @return string
     */
    public function getTagListAttribute()
    {
        $tags = $this->tags->lists('name')->toArray();

        return implode(',', $tags);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }
}