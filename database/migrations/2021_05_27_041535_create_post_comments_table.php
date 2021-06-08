<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->onDelete('cascade')->comment('ID of the comment author');
            $table->foreignId('post_id')->onDelete('cascade')->nullable()->comment('ID of the post');
            $table->foreignId('post_comment_id')->onDelete('cascade')->nullable()->comment('ID of the post comment if a reply');
            $table->string('content')->comment('Comment content');
            $table->timestamps();
            $table->foreign('user_id')->onDelete('cascade')->references('id')->on('users');
            $table->foreign('post_id')->onDelete('cascade')->references('id')->on('posts');
            $table->foreign('post_comment_id')->onDelete('cascade')->references('id')->on('post_comments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_comments');
    }
}
