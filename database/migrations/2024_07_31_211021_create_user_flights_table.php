<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('flight_id')->constrained()->onDelete('cascade');
            $table->string('seat_number')->nullable();
            $table->date('booking_date')->default(now());
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_flights');
    }
};
