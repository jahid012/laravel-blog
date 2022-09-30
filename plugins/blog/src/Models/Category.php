<?php

namespace Plugins\Blog\Models;

use App\Models\PostsTopics;
use App\Support\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use UuidTrait;

    protected $table = 'blog_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    public function posts()
    {
        return $this->hasOne(Category::class, 'category_id', 'id');
    }
}
