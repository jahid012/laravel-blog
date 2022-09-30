<?php

namespace Plugins\Faq\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    use HasFactory, UuidTrait;

    public $table = 'faqs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'ask', 'answer'
    ];

}
