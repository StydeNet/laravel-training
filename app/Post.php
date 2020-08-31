<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content'];

    public function author()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Styde'
        ]);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_category')
            ->withPivot(['featured'])
            ->withTimestamps();
    }

    public function addCategories(Category ...$categories)
    {
        $this->categories()->syncWithoutDetaching(new Collection($categories));
    }

    public function getFeaturedAttribute($value)
    {
        return (bool) $value;
    }

    public function getIsPublishedAttribute()
    {
        return $this->published_at != null;
    }
}
