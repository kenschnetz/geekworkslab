<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateImagesTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('images', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id');
                $table->string('name', 80);
                $table->string('path', 400)->comment('Path of the image on teh server');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('user_id')->onDelete('cascade')->references('id')->on('users');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::dropIfExists('images');
        }
    }
