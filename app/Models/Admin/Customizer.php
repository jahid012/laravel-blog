<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Customizer extends Model
{

    protected $fillable = [
        "user_id", "name", "image", "typography", "version", "layout", "sidebarStyle", "sidebarPosition", "headerPosition",
        "containerLayout", "direction", "navheaderBg", "headerBg", "sidebarBg", "order",
    ];
}
