<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreatePostRatingsTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('post_ratings', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->onDelete('cascade')->comment('ID of the rater');
                $table->foreignId('post_id')->onDelete('cascade')->nullable()->comment('ID of the post');
                $table->integer('rating')->default(5)->comment('Submitted rating');
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
            Schema::dropIfExists('post_ratings');
        }
    }
