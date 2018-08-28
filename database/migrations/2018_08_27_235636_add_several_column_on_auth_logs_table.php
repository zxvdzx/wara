<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeveralColumnOnAuthLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auth_logs', function (Blueprint $table) {
            $table->string('platform_name')->nullable();
            $table->string('device_family')->nullable();
            $table->string('browser_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auth_logs', function (Blueprint $table) {
            $table->dropColumn('platform_name');
            $table->dropColumn('device_family');
            $table->dropColumn('browser_name');
        });
    }
}
