<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCategoryRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post__category__relations', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('post_category_id');

            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('post_category_id')->references('id')->on('post_categories');

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
        Schema::dropIfExists('post__category__relations');
    }
}
