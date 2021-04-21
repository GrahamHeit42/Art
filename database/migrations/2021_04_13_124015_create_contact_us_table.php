<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('phone')->index();
            $table->string('email')->index();
            $table->string('subject')->nullable();
            $table->longText('message')->nullable();
            $table->tinyInteger('status')->default('1')->comment('1 => Active , 0 => inactive')->index();
            $table->tinyInteger('is_deleted')->default('0')->comment('1 => Soft Delete');
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
        Schema::dropIfExists('contact_us');
    }
}
