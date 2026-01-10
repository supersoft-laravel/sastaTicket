<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flight_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id')->unique()->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->date('dob')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('address')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('visa_no')->nullable();

            // Flight information
            $table->string('flight_airline');
            $table->string('flight_class');
            $table->string('flight_from');
            $table->string('flight_to');
            $table->dateTime('flight_departure_datetime');
            $table->dateTime('flight_arrival_datetime');
            $table->integer('flight_stops')->default(0);
            $table->string('flight_duration')->nullable();
            $table->text('flight_segments')->nullable();

            // Booking details
            $table->date('departure_date');
            $table->integer('adults')->default(1);
            $table->integer('children')->default(0);
            $table->integer('infants')->default(0);

            //Return
            $table->string('return_from');
            $table->string('return_to');
            $table->dateTime('return_departure_datetime');
            $table->dateTime('return_arrival_datetime');
            $table->integer('return_stops')->default(0);
            $table->string('return_duration')->nullable();
            $table->text('return_segments')->nullable();
            $table->date('return_date')->nullable();

            // Pricing
            $table->decimal('flight_price', 10, 2);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2);

            // Payment
            $table->enum('payment_method', ['cod', 'online', 'card'])->default('cod');

            // Extra fields
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->text('notes')->nullable(); // for admin notes or special requests
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_bookings');
    }
};
