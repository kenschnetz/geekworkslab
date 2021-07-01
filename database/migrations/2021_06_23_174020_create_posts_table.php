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
                $table->foreignId('user_id');
                $table->foreignId('post_id')->nullable();
                $table->foreignId('content_type_id');
                $table->foreignId('content_subtype_id');
                $table->foreignId('system_id');
                $table->foreignId('category_id')->nullable();
                $table->boolean('locked')->default(true)->comment('For art posts, determine if other users may clone this art for use in a standard post');
                $table->boolean('published')->default(false);
                $table->boolean('moderated')->default(false)->comment('When set to true, this post has been moderated and hidden from view by anyone but the owner, moderators and admins');
                $table->string('title', 80);
                $table->string('slug', 80)->unique();
                $table->string('description', 500)->nullable();
                $table->text('content')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('user_id')->onDelete('cascade')->references('id')->on('users');
                $table->foreign('content_type_id')->onDelete('cascade')->references('id')->on('content_types');
                $table->foreign('content_subtype_id')->onDelete('cascade')->references('id')->on('content_subtypes');
                $table->foreign('post_id')->onDelete('cascade')->references('id')->on('posts');
                $table->foreign('system_id')->onDelete('cascade')->references('id')->on('systems');
                $table->foreign('category_id')->onDelete('cascade')->references('id')->on('categories');
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
