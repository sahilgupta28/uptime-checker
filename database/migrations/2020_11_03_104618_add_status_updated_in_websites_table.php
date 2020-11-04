<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusUpdatedInWebsitesTable extends Migration
{
    public function up()
    {
        Schema::table('websites', function (Blueprint $table) {
            $table->timestamp('status_updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('websites', function (Blueprint $table) {
            Schema::dropIfExists('status_updated_at');
        });
    }
}
