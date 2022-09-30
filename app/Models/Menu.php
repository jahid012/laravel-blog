<?php

namespace App\Models;

use App\Support\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\HtmlString;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory, UuidTrait;

    public static function boot()
    {
        parent::boot();

        static::creating(function (self $model): void {
            $model->keyType = 'string';
            $model->incrementing = false;

            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
        static::saved(function ($model) {
            $model->removeMenuFromCache();
        });

        static::deleted(function ($model) {
            $model->removeMenuFromCache();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name'
    ];

    /**
     * Get all of items
     * @return mix
     */
    private function items()
    {
        return $this->hasMany(MenuItem::class, 'menu_id', 'id');
    }

    /**
     * Get Parent menu item
     */
    public function parent_items()
    {
        return $this->hasMany(MenuItem::class, 'menu_id', 'id')->whereNull('parent_id');
    }


    /**
     * Display menu.
     *
     * @param string      $menuName
     * @param string|null $type
     * @param array       $options
     *
     * @return string
     */
    public static function display($menuName, $type = null, array $options = [])
    {
        // $return = static::where('name', $menuName)
        //     ->with(['parent_items.children' => function ($q) {
        //         $q->orderBy('order');
        //     }])
        //     ->first();
        //     return dd($return);

        // GET THE MENU - sort collection in blade
        $menu = Cache::remember('menu_'.$menuName, Carbon::now()->addDays(30), function () use ($menuName) {
            return static::where('name', $menuName)
            ->with(['parent_items.children' => function ($q) {
                $q->orderBy('order');
            }])
            ->first();
        });

        // Check for Menu Existence
        if (!isset($menu)) {
            return false;
        }

        // event(new MenuDisplay($menu));

        // Convert options array into object
        $options = (object) $options;

        $items = $menu->parent_items->sortBy('order');

        if ($menuName == 'builder' && $type == '_json') {
            $items = static::processItems($items);
        }

        if ($type == 'builder') {
            $type = 'menu.'.$type;
        } else {
            if (is_null($type)) {
                $type = 'menu.default';
            } elseif ($type == 'bootstrap' && !view()->exists($type)) {
                $type = 'menu.bootstrap';
            }
        }

        if (!isset($options->locale)) {
            $options->locale = app()->getLocale();
        }

        if ($type === '_json') {
            return $items;
        }
        return new HtmlString(
            View::make($type, ['items' => $items, 'options' => $options])->render()
        );
    }

    /**
     * Get menu by name
     */
    public static function findByName($name)
    {
        return self::where('name', $name)->first();
    }

    /**
     * Get all of items
     */
    public function children()
    {
        $data = [];
        $children = $this->items()->get()->toArray();

        foreach ($children as $v) {

            // no parent
            if($v['parent_id'] == 0){
                $data[$v['id']] = $v;
            }else{

                 // 1st parent
                if(isset($data[$v['parent_id']]) == false){
                    $data[$v['parent_id'].'.'. $data[$v['id']]] = $v;
                }else{
                     // 2nd parent
                    $data[$data[$v['parent_id']].'.'.$v['parent_id'].'.'. $data[$v['id']]] = $v;
                }
            }
        }

        return array_undot($data);
    }

    /**
     * Remove cache data
     */
    public function removeMenuFromCache()
    {
        Cache::forget('menu_'.$this->name);
    }

}
