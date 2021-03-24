<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActiveDeleteRemoveStatusInUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->tinyInteger('is_active')->default(0)->nullable()->after('phone');
            $table->tinyInteger('is_delete')->default(0)->nullable()->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('status');
            $table->dropColumn('is_active');
            $table->dropColumn('is_delete');
        });
    }
}
