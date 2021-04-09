<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsNewTable extends Migration
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
            $table->tinyInteger('user_type')->default(0);
            $table->tinyInteger('artist_type')->nullable();
            $table->foreignId('drawnBy')->constrained('users')->cascadeOnDelete()->nullable();
            $table->foreignId('commisioned_by')->constrained('users')->cascadeOnDelete()->nullable();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->foreignId('medium_id')->constrained('mediums')->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->tinyInteger('c_price')->nullable();
            $table->tinyInteger('c_speed')->nullable();
            $table->tinyInteger('c_quality')->nullable();
            $table->tinyInteger('c_communication')->nullable();
            $table->tinyInteger('c_work_again')->nullable();
            $table->tinyInteger('a_transaction')->nullable();
            $table->tinyInteger('a_concept')->nullable();
            $table->tinyInteger('a_understanding')->nullable();
            $table->tinyInteger('a_communication')->nullable();
            $table->tinyInteger('a_work_again')->nullable();
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
