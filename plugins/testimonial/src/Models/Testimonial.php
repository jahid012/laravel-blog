<?php

namespace Plugins\Testimonial\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\UuidTrait;

class Testimonial extends Model
{
    use UuidTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'quote', 'author_name', 'author_image', 'author_intro'
    ];
}
