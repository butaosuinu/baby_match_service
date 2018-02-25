<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_id')->unsigned()->index();
            $table->integer('contractor_id')->unsigned()->index();
            $table->timestamps();
            
            $table->foreign('request_id')->references('id')->on('requests')->onDelete('cascade');
            $table->foreign('contractor_id')->references('id')->on('users')->onDelete('no action');

            // request_idとcontractor_idの組み合わせの重複を許さない
            $table->unique(['request_id', 'contractor_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contracts');
    }
}
