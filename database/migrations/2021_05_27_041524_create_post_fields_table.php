<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_meta_id')->onDelete('cascade')->nullable()->comment('ID of the post meta');
            $table->string('name', 80)->nullable()->comment('Field name');
            $table->string('value');
            $table->timestamps();
            $table->foreign('post_meta_id')->onDelete('cascade')->references('id')->on('post_metas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_fields');
    }
}
