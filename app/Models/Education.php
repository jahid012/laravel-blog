<?php

namespace App\Models;

class Education extends Post
{
    protected $post_type = 'education';


    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [];
}
