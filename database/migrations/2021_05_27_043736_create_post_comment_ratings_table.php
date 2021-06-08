<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreatePostCommentRatingsTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('post_comment_ratings', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->onDelete('cascade')->comment('ID of the rater');
                $table->foreignId('post_comment_id')->onDelete('cascade')->nullable()->comment('ID of the post comment');
                $table->boolean('rating')->default(true)->comment('true = upvote, false = downvote');
                $table->timestamps();
                $table->foreign('user_id')->onDelete('cascade')->references('id')->on('users');
                $table->foreign('post_comment_id')->onDelete('cascade')->references('id')->on('post_comments');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::dropIfExists('post_comment_ratings');
        }
    }
