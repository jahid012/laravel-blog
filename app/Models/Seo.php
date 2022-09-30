<?php

namespace App\Models;

use App\Support\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use UuidTrait;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seos';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        // Primary Meta Tags
        'title' => 'string',
        'description' => 'string',
        'keywords' => 'string',
        // Open Graph / Facebook
        'og_type' => 'string',
        'og_url' => 'string',
        'og_title' => 'string',
        'og_description' => 'string',
        'og_image',
        // Twitter
        'twitter_card' => 'string',
        'twitter_url' => 'string',
        'twitter_title' => 'string',
        'twitter_description' => 'string',
        'twitter_image' => 'string',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        // Primary Meta Tags
        'title',
        'description',
        'keywords',
        // Open Graph / Facebook
        'og_type',
        'og_url',
        'og_title',
        'og_description',
        'og_image',
        // Twitter
        'twitter_card',
        'twitter_url',
        'twitter_title',
        'twitter_description',
        'twitter_image',
    ];


    /**
     *
     * Get user uuuid
     */
    public function getId()
    {
        return $this->attributes['id'];
    }

}
