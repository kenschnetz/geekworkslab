<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateUserBadgesTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('user_badges', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id');
                $table->foreignId('badge_id');
                $table->integer('points')->comment('The number of points the user has earned towards the related badge');
                $table->boolean('earned')->comment('If true, the user has earned this badge and no longer earns progress towards it');
                $table->timestamps();
                $table->foreign('user_id')->onDelete('cascade')->references('id')->on('users');
                $table->foreign('badge_id')->onDelete('cascade')->references('id')->on('badges');
                $table->unique(['user_id', 'badge_id']);
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::dropIfExists('user_badges');
        }
    }
