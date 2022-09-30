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
        Schema::create('pages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignUuid('seo_id')->nullable()->constrained()->onDelete('cascade');

            // post type  etc[ post, page, etc]
            $table->string('locale');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('summary')->nullable();
            $table->longText('content')->nullable();
            $table->string('thumbnail')->nullable();
            $table->enum('status', ['published', 'private', 'draft'])->default('published');

            $table->string('layout')->nullable();
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
        Schema::dropIfExists('pages');
    }
};
