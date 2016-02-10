<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPracticantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practicantes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('dojo');
            $table->string('typemember');
            $table->string('actual_rank');
            $table->string('bbnumber');
            $table->string('email');
            $table->date('yearbegin');
            $table->string('policecourse');
            $table->text('comments');
            
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
        Schema::drop('practicantes');
    }
}
