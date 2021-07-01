<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateReportedPostCommentsTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('reported_post_comments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('post_comment_id');
                $table->foreignId('user_id');
                $table->string('reason', 100);
                $table->timestamps();
                $table->foreign('post_comment_id')->onDelete('cascade')->references('id')->on('post_comments');
                $table->foreign('user_id')->onDelete('cascade')->references('id')->on('users');
                $table->unique(['post_comment_id', 'user_id']);
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::dropIfExists('reported_post_comments');
        }
    }
