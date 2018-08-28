<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditrailLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditrail_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->nullable();
            $table->string('action')->nullable();
            $table->string('table_name')->nullable();
            $table->text('old_data')->nullable();
            $table->text('new_data')->nullable();
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
        Schema::dropIfExists('auditrail_logs');
    }
}
