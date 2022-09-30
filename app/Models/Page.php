<?php

namespace App\Models;

use App\Support\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory, UuidTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'locale', 'title', 'slug', 'status', 'user_id', 'layout','summary', 'content', 'parent_id', 'thumbnail', 'seo_id'
    ];

    /**
     * Get the Seo associated with the post.
     */
    public function seo()
    {
        // return dd($this->seo_id);
        // return Seo::find($this->seo_id);
        return $this->hasOne( Seo::class,  'id', 'seo_id', );
    }

    /**
     *
     * Get user uuuid
     */
    public function getId()
    {
        return $this->attributes['id'];
    }

}
