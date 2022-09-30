<?php

namespace App\Models;

use App\Support\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use UuidTrait;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'removable' => 'boolean'
    ];
}
