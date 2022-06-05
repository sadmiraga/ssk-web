<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->date('date');
            $table->time('time');
            $table->string('location');
            $table->integer('ticketPrice')->nullable();
            $table->integer('specialTicketPrice')->nullable();
            $table->text('description');
            $table->string('picture');


            $table->unsignedBigInteger('form_id')->nullable();

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
        Schema::dropIfExists('events');
    }
}
