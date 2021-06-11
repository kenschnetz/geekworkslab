<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreatePostsTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('posts', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->onDelete('cascade')->comment('ID of the author');
                $table->foreignId('post_id')->onDelete('cascade')->nullable()->comment('ID of the originating post if exists');
                $table->integer('type')->defualt(0)->comment('0 = original post, 1 = branch of parent, 2 = recommended changes for parent post');
                $table->boolean('published')->default(false)->comment('Whether this post is published and visible to the public');
                $table->timestamps();
                $table->foreign('user_id')->onDelete('cascade')->references('id')->on('users');
                $table->foreign('post_id')->onDelete('cascade')->references('id')->on('posts');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::dropIfExists('posts');
        }
    }
