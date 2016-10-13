<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->text('post');
            $table->integer('user_id');
            $table->String('image');
            $table->integer('check_image')->default(0);
            $table->integer('privacy')->default(0);//public=1,friend=0
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));// ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
