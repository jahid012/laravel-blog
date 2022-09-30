<?php

namespace Plugins\Contact\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory, UuidTrait;

    public $table = 'contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'parent_id', 'name', 'email', 'phone', 'subject', 'address', 'message', 'is_read',
    ];

    protected static function newFactory()
    {
        return \Plugins\Contact\Database\Factories\ContactFactory::new();
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

}
