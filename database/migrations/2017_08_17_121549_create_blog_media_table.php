<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('path');
            $table->integer('post_id')->unsigned()->index();
            $table->foreign('post_id')->references('id')->on('blog_posts')->onDelete('cascade');
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
        Schema::dropIfExists('blog_media');
    }
}
