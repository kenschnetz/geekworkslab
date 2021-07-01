<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreatePostAttributesTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('post_attributes', function (Blueprint $table) {
                $table->id();
                $table->foreignId('post_id');
                $table->foreignId('attribute_id');
                $table->string('value', 80)->comment('Corresponding value for the attribute');
                $table->timestamps();
                $table->foreign('post_id')->onDelete('cascade')->references('id')->on('posts');
                $table->foreign('attribute_id')->onDelete('cascade')->references('id')->on('attributes');
                $table->unique(['post_id', 'attribute_id']);
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::dropIfExists('post_attributes');
        }
    }
