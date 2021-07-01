<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreatePostImagesTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('post_images', function (Blueprint $table) {
                $table->id();
                $table->foreignId('post_id');
                $table->foreignId('image_id');
                $table->timestamps();
                $table->foreign('post_id')->onDelete('cascade')->references('id')->on('posts');
                $table->foreign('image_id')->onDelete('cascade')->references('id')->on('images');
                $table->unique(['post_id', 'image_id']);
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::dropIfExists('post_images');
        }
    }
