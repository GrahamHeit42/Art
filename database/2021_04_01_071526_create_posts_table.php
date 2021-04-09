<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('name', 100);
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->string('image', 100)->nullable();
            $table->double('price')->nullable()->default(0);
            $table->tinyInteger('speed')->nullable()->default(0);
            $table->tinyInteger('quality')->nullable()->default(0);
            $table->tinyInteger('professonalism')->nullable()->default(0);
            $table->tinyInteger('communication')->nullable()->default(0);
            $table->tinyInteger('transaction')->nullable()->default(0);
            $table->tinyInteger('prepertion')->nullable()->default(0);
            $table->tinyInteger('again')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
