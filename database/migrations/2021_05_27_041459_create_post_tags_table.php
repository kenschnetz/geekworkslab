<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreatePostTagsTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('post_tags', function (Blueprint $table) {
                $table->id();
                $table->foreignId('post_id')->onDelete('cascade')->nullable()->comment('ID of the post');
                $table->foreignId('tag_id')->onDelete('cascade')->nullable()->comment('ID of the tag');
                $table->timestamps();
                $table->foreign('post_id')->onDelete('cascade')->references('id')->on('posts');
                $table->foreign('tag_id')->onDelete('cascade')->references('id')->on('tags');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::dropIfExists('post_tags');
        }
    }
