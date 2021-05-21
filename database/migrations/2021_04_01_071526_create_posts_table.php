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
            //            $table->tinyInteger('user_type')->default(0);
            //            $table->tinyInteger('artist_type')->nullable();
            $table->foreignId('drawn_by')->nullable()->constrained('usernames')->cascadeOnDelete();
            $table->foreignId('commisioned_by')->nullable()->constrained('usernames')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->foreignId('medium_id')->constrained('mediums')->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->text('keywords')->nullable();
            $table->double('price', 10, 2)->default(0)->nullable();
            $table->double('speed', 10, 2)->default(0)->nullable();
            $table->double('quality', 10, 2)->default(0)->nullable();
            $table->double('communication', 10, 2)->default(0)->nullable();
            $table->double('transaction', 10, 2)->default(0)->nullable();
            $table->double('concept', 10, 2)->default(0)->nullable();
            $table->double('understanding', 10, 2)->default(0)->nullable();
            $table->boolean('want_work_again')->default(0)->comment('0-No, 1-Yes');
            $table->boolean('status')->default(0)->comment('0-Inactive, 1-Active');
            $table->tinyInteger('maturity_rating')->nullable();
            $table->softDeletes();
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
