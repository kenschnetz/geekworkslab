<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreatePostCommentsTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('post_comments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('post_id');
                $table->foreignId('user_id');
                $table->foreignId('post_comment_id')->nullable()->comment('If not null, this is a reply to the related post_comment');
                $table->text('content');
                $table->boolean('moderated')->default(false)->comment('When set to true, this post has been moderated and hidden from view by anyone but the owner, moderators and admins');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('post_id')->onDelete('cascade')->references('id')->on('posts');
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
            Schema::dropIfExists('post_comments');
        }
    }
