<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('google_id', 100)->unique()->nullable();
            $table->string('facebook_id', 100)->unique()->nullable();
            $table->string('display_name', 100)->nullable();
            $table->string('username', 100)->unique();
            $table->string('email', 200)->unique();
            $table->string('password', 255)->nullable();
            $table->string('profile_image', 100)->nullable();
            $table->tinyInteger('status')->default(0)->comment('0-Inactive, 1-Active, 2-Blocked');
            $table->tinyInteger('is_admin')->default(0);
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
