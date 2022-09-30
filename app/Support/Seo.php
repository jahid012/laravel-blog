<?php

namespace App\Support;

use App\Models\Seo as SeoMeta;

class Seo
{

    /**
     * The theme's attributes.
     *
     * @var array
     */
    public $attributes = [];


    public function find($id)
    {
        $seo = SeoMeta::where('id', $id)->first();

        if($seo != null){
            $this->attributes = $seo->toArray();
        }

        return $this;
    }

    /**
     * Save a new model and return the instance.
     *
     * @param  array  $attributes
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public function create(array $attributes = [])
    {
        return SeoMeta::create($attributes);
    }

    /**
     * Update records in the database.
     *
     * @param int $id
     * @param  array  $values
     * @return int
     */
    public function update($id, array $values)
    {
        return SeoMeta::where('id', $id)->update($values);
    }

    /**
     * get attribute
     * @param attribute $name
     * @return string
     */
    public function __get ( $name ){

        if(isset($this->attributes[$name]) == true){
            return $this->attributes[$name];
        }

        if($name == 'og_type'){
            return 'article';
        }

        if($name == 'twitter_card'){
            return 'summary';
        }

        return "";
    }

}
