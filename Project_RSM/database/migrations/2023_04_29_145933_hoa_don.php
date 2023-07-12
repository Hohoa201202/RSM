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
        Schema::create('tbl_Orders', function (Blueprint $table) {
            $table->increments('IdOrder');

            $table->unsignedInteger('IdCustomer')->nullable();
            $table->unsignedInteger('IdBooking')->nullable();
            $table->unsignedInteger('IdTable')->nullable();
            $table->unsignedInteger('Discount')->nullable();
            $table->unsignedInteger('IdUser')->nullable();

            $table->dateTime('OrderDate')->nullable();

            $table->dateTime('TimeIn')->nullable();
            $table->dateTime('TimeOut')->nullable();

            $table->decimal('TotalAmount', 10, 2)->nullable();

            $table->string('PaymentMethod', 50)->nullable();
            $table->dateTime('PaymentTime')->nullable();
            $table->unsignedInteger('Status');
            $table->string('Notes', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_Orders');
    }
};
