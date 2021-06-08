<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreatePostCategoriesTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('post_categories', function (Blueprint $table) {
                $table->id();
                $table->foreignId('post_id')->onDelete('cascade')->nullable()->comment('ID of the post');
                $table->foreignId('category_id')->onDelete('cascade')->nullable()->comment('ID of the category');
                $table->timestamps();
                $table->foreign('post_id')->onDelete('cascade')->references('id')->on('posts');
                $table->foreign('category_id')->onDelete('cascade')->references('id')->on('categories');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::dropIfExists('post_categories');
        }
    }
