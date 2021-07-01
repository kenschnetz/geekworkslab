<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateReportedPostsTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('reported_posts', function (Blueprint $table) {
                $table->id();
                $table->foreignId('post_id');
                $table->foreignId('user_id');
                $table->string('reason', 100);
                $table->timestamps();
                $table->foreign('post_id')->onDelete('cascade')->references('id')->on('posts');
                $table->foreign('user_id')->onDelete('cascade')->references('id')->on('users');
                $table->unique(['post_id', 'user_id']);
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::dropIfExists('reported_posts');
        }
    }
