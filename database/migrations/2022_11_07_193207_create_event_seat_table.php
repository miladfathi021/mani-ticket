<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_seat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')
                ->constrained('events')
                ->cascadeOnDelete();

            $table->foreignId('event_hall_id')
                ->constrained('event_hall')
                ->cascadeOnDelete();

            $table->foreignId('seat_id')
                ->constrained('seats')
                ->cascadeOnDelete();

            $table->foreignId('reserved_by')
                ->nullable()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->unsignedSmallInteger('seat_status');

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
        Schema::dropIfExists('event_seat');
    }
};
