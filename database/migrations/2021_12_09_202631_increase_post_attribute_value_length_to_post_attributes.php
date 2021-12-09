<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class IncreasePostAttributeValueLengthToPostAttributes extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::table('post_attributes', function (Blueprint $table) {
                $table->string('value', 400)->change();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::table('post_attributes', function (Blueprint $table) {
                $table->string('value', 80)->change();
            });
        }
    }
