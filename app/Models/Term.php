<?php

namespace App\Models;

use App\Support\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use UuidTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'post_id', 'post_key', 'post_value',
    ];
}

