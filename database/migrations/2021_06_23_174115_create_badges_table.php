<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateBadgesTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('badges', function (Blueprint $table) {
                $table->id();
                $table->string('name', 80)->unique();
                $table->string('description', 200);
                $table->string('required_points')->comment('The number of points required to earn this badge');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::dropIfExists('badges');
        }
    }
