<?php

namespace App\Models;

use App\Support\Traits\HasRolePermissions;
use App\Support\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasRolePermissions, UuidTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'display_name'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'removable' => 'boolean'
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public $primaryRoles = [
        'users', 'admin'
    ];


    /**
     * A role may be given various permissions.
     *
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }

    /**
     * Get the comments for the Role.
     *
     */
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }

    /**
     * @param string $name
     * @return
     */
    public static function findByName( string $name)
    {
        return self::where('name', $name)->first();
    }

    /**
     * @param string $id
     * @return
     */
    public static function findById( string $id)
    {
        return self::where('id', $id)->first();
    }


    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @param  array  $options
     * @return bool
     */
    public function update(array $attributes = [], array $options = [])
    {
        if (! $this->exists) {
            return false;
        }


        if(!$this->isRemovable()){
            return false;
        }

        return $this->fill($attributes)->save($options);
    }

    /**
     * Override "save" role method to clear role cache.
     * @param array $options
     */
    public function save(array $options = [])
    {
        parent::save($options);
        $this->flushCache();
    }

    /**
     * Override "delete" role method to clear role cache.
     * @param array $options
     * @throws \Exception
     */
    public function delete(array $options = [])
    {
        $this->flushCache();
        parent::delete($options);
    }

    /**
     * Override "restore" role method to clear role cache.
     */
    public function restore()
    {
        $this->flushCache();
        parent::restore();
    }

    /**
     * Get all primary roles
     * @return array
     */
    public function getPrimaryRolesName()
    {
        return $this->primaryRoles;
    }

    /**
     * Get primary roles | default 'user'
     * @return mix
     */
    public static function primaryRole()
    {
        return self::findByName((new static)->primaryRoles[0]);
    }

    /**
     * check primary or predefined role
     * @param string $roleName
     * @return booelan
     */
    public function isRemovable($roleName = null): bool
    {
        if($roleName == null){
            $roleName = $this->attributes['name'];
        }
        return !in_array($roleName, $this->primaryRoles);
    }

    /**
     *
     * Get user uuuid
     */
    public function getId()
    {
        return $this->attributes['id'];
    }

}
