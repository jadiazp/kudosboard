<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKudosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('kudos', function (Blueprint $table) {
        $table->id();
        $table->bigInteger('iduser')->unsigned();
        $table->bigInteger('idboard')->unsigned();
        $table->text('description');
        $table->timestamps();
        $table->index('iduser');
        $table->index('idboard');
        $table->foreign('iduser')->references('id')->on('users');
        $table->foreign('idboard')->references('id')->on('boards');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('kudos');
    }
}
