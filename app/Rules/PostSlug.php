<?php

namespace App\Rules;

// use App\Models\Post;
use Illuminate\Contracts\Validation\Rule;

class PostSlug implements Rule
{
    public $type ;
    public $except ;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($type, $except = false )
    {
        $this->type = $type;
        $this->except = $except;

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // $post = Post::where([
        //     'locale' => request()->input('locale', app()->getLocale() ),
        //     'slug' => $value,
        //     'type' => $this->type,
        // ])->first();

        // if($post == null ){
        //     return true;
        // }

        // if($this->except && $post->slug == $value ){
        //     return true;
        // }

        return true;

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Slug must be unique.';
    }
}
