<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateBannedUsersTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('banned_users', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id');
                $table->string('reason')->comment('Reason for the ban');
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
            Schema::dropIfExists('banned_users');
        }
    }
