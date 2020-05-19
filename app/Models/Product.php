<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name','price', 'slug', 'description', 'image', 'category_id'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    protected $appends=['image_path'];

    public function getImageUrlAttribute()
    {
        return asset('images/'.$this->image);
    }
}
