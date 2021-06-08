<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_content', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->onDelete('cascade')->nullable()->comment('ID of the post');
            $table->string('name', 255)->nullable()->comment('Post name');
            $table->string('description', 510)->nullable()->comment('Post description');
            $table->string('image_url')->nullable()->comment('Post image url');
            $table->string('content')->nullable()->comment('Post content');
            $table->integer('status')->default(0)->comment('0 = draft, 1 = published, 2 = locked');
            $table->integer('version')->default(1)->comment('Post version number');
            $table->timestamps();
            $table->foreign('post_id')->onDelete('cascade')->references('id')->on('posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_content');
    }
}
