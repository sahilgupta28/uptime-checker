<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFibonacciSeriesKeys extends Migration
{
    public function up()
    {
        Schema::table('websites', function (Blueprint $table) {
            $table->dateTime('notification_started_at')->nullable();
            $table->smallInteger('notification_key')->default(0);
        });
    }

    public function down()
    {
        Schema::table('websites', function (Blueprint $table) {
            $table->dropColumns(['notification_started_at', 'notification_key']);
        });
    }
}
