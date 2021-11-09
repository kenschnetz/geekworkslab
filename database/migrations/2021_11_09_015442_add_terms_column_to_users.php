<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class AddTermsColumnToUsers extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('terms_accepted')->default(false)->after('email');
                $table->datetime('terms_accepted_date')->nullable()->after('terms_accepted');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('terms_accepted');
                $table->dropColumn('terms_accepted_date');
            });
        }
    }
