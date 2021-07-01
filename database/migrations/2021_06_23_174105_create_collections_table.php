<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateCollectionsTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('collections', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id');
                $table->string('name', 80)->unique();
                $table->string('description', 200)->nullable();
                $table->timestamps();
                $table->foreign('user_id')->onDelete('cascade')->references('id')->on('users');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::dropIfExists('collections');
        }
    }
