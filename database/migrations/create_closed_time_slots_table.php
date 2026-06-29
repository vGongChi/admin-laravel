<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClosedTimeSlotsTable extends Migration
{
    public function up()
    {
        Schema::create('closed_time_slots', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('time_slot');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('closed_time_slots');
    }
}
