<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateRolePermissionsTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('role_permissions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('role_id');
                $table->foreignId('permission_id');
                $table->foreign('role_id')->onDelete('cascade')->references('id')->on('roles');
                $table->foreign('permission_id')->onDelete('cascade')->references('id')->on('permissions');
                $table->unique(['role_id', 'permission_id']);
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::dropIfExists('role_permissions');
        }
    }
