<?php

namespace Plugins\Portfolio\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\UuidTrait;

class Portfolio extends Model
{
    use UuidTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'image', 'name', 'category'
    ];


}
