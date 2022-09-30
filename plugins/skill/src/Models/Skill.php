<?php

namespace Plugins\Skill\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\UuidTrait;

class Skill extends Model
{
    use UuidTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'type', 'name', 'percentage'
    ];


}
