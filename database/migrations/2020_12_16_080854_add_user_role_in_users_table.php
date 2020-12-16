<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserRoleInUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('role')->default(config('constants.ROLE.USER'));
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            Schema::dropIfExists('role');
        });
    }
}
