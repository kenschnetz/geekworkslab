<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class IncreaseTitleLengthToPosts extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::table('posts', function (Blueprint $table) {
                $table->string('title', 400)->change();
                $table->string('slug', 600)->change();
                $table->text('description')->change();
                $table->mediumtext('description')->change();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {}
    }
