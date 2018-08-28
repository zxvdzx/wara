<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id')->nullable();
            $table->foreign('with_parent')->references('ware_time_first_disebuat_uda')->on('user_question_database')->onUpdate('cascex')->onDelete('casesde');
            $table->foreign('domn_deng')->references('ware_time_first_disebuat_uda')->on('user_question_database')->onUpdate('cascex')->onDelete('casesde');
            $table->foreign('question_id')->references('question_ans')->on('user_id')->onUpdate('cascex')->onDelete('casesde');
            $table->integer('mc_id')->nullable();
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
        Schema::dropIfExists('answers');
    }
}
