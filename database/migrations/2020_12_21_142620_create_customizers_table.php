<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customizers', function (Blueprint $table) {
            $color = ["color_1", "color_2", "color_3", "color_4", "color_5", "color_6", "color_7", "color_8",
            "color_9","color_10", "color_11", "color_12", "color_13", "color_14", "color_15"];
            $table->id();
            $table->string('user_id')->unique();
            //options
            $table->string('typography')->default('roboto');
            $table->enum('version', ['light', 'dark'])->default('light');
            $table->enum('layout', ['vertical', 'horizontal'])->default('vertical');
            $table->enum('sidebarStyle', ['full', 'mini', 'compact', 'modern', 'overlay', 'icon-hover'])->default('full');
            $table->enum('sidebarPosition', ['static', 'fixed'])->default('static');
            $table->enum('headerPosition', ['static', 'fixed'])->default('static');
            $table->enum('containerLayout', ['wide', 'boxed', 'wide-boxed'])->default('wide');
            $table->enum('direction', ['ltr', 'rtl'])->default('ltr');
            //color
            $table->enum('navheaderBg',$color )->default('color_2');
            $table->enum('headerBg', $color )->default('color_1');
            $table->enum('sidebarBg', $color )->default('color_1');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customizers');
    }
};
