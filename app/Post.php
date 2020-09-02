<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content'];

    protected $casts = [
        'featured' => 'bool',
        'published_at' => 'datetime:d/m/Y H:i',
    ];

    protected $visible = ['title', 'content', 'published_at', 'is_published', 'author'];

    protected $appends = ['is_published'];

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

    public function getIsPublishedAttribute()
    {
        return $this->published_at != null;
    }
}
