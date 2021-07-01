<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateCollectionPostsTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('collection_posts', function (Blueprint $table) {
                $table->id();
                $table->foreignId('collection_id');
                $table->foreignId('post_id');
                $table->timestamps();
                $table->foreign('collection_id')->onDelete('cascade')->references('id')->on('collections');
                $table->foreign('post_id')->onDelete('cascade')->references('id')->on('posts');
                $table->unique(['collection_id', 'post_id']);
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::dropIfExists('collection_posts');
        }
    }
