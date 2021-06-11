<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreatePostVotesTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('post_votes', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->onDelete('cascade')->comment('ID of the rater');
                $table->foreignId('post_id')->onDelete('cascade')->nullable()->comment('ID of the post');
                $table->boolean('vote')->comment('Submitted vote');
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
            Schema::dropIfExists('post_votes');
        }
    }
