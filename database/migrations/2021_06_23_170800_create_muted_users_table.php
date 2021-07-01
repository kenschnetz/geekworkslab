<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateMutedUsersTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('muted_users', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id');
                $table->datetime('expiration')->comment('Date and time the mute expires');
                $table->string('reason')->comment('Reason for the mute');
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
            Schema::dropIfExists('muted_users');
        }
    }
