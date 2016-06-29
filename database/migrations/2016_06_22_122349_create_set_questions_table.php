<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('set_questions', function (Blueprint $table) {

            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->integer('timehr');
            $table->integer('timemin');
            $table->text('category');
            $table->integer('noquestion');
            $table->integer('mark');
            $table->integer('negativemark');
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
        Schema::drop('set_questions');
    }
}
