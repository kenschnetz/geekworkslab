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
            $table->foreignId('post_id')->onDelete('cascade')->nullable()->comment('ID of the post');
            $table->string('name', 80)->nullable()->comment('Field name');
            $table->string('description', 510)->nullable()->comment('Field description');
            $table->string('key', 80)->comment('Field key');
            $table->integer('type')->comment('0 = string, 1 = integer, 2 = boolean, 3 = timestamp');
            $table->string('string_value')->nullable();
            $table->integer('integer_value')->nullable();
            $table->boolean('boolean_value')->nullable();
            $table->timestamp('timestamp_value')->nullable();
            $table->timestamps();
            $table->foreign('post_id')->onDelete('cascade')->references('id')->on('posts');
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
