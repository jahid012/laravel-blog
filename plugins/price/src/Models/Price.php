<?php

namespace Plugins\Price\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\UuidTrait;

class Price extends Model
{
    use UuidTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'icon', 'name', 'price', 'info', 'link'
    ];


}
