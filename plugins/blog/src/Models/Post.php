<?php

namespace Plugins\Blog\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Post extends Model
{
    use UuidTrait, HasFactory;

    protected $table = 'blog_posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'category_id',
        "seo_id",
        "user_id",
        'title',
        'slug',
        'summary',
        'content',
        'featured_image',
        'tags',
    ];


    protected static function newFactory()
    {
        return \Plugins\Blog\Database\Factories\PostFactory::new();
    }


    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id')->where('ducor_comments.parent_id', 0)->with('children');
    }

    /**
     *
     */
    public function poststopic()
    {
        return $this->hasOne(PostsTopics::class,  'post_id', 'post_id' );
    }

    /**
     * Get the topic relationship.
     *
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     *Get the User relationship.
     */
    public function auth()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
