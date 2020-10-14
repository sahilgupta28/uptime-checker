<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActiveInWebsitesTable extends Migration
{
    public function up()
    {
        Schema::table('websites', function (Blueprint $table) {
            $table->boolean('is_active')->default(1);
        });
    }

    public function down()
    {
        Schema::table('websites', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
}
