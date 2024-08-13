<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('origin');
            $table->string('destination');
            $table->date('flight_date');
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->string('company_name');
            $table->string('logo_url')->nullable();
            $table->string('slug')->unique();
            $table->decimal('price_usd', 9, 2);
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('flights');
    }
};
