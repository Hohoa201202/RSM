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
        Schema::create('tbl_Booking', function (Blueprint $table) {
            $table->increments('IdBooking');
            $table->unsignedInteger('IdCustomer')->nullable();

            $table->unsignedInteger('IdBranch');
            $table->foreign('IdBranch')
                ->references('IdBranch')
                ->on('dm_tbl_Branchs');

            $table->unsignedInteger('Discount')->nullable();

            $table->unsignedInteger('IdTable')->nullable();

            $table->datetime('BookingDate')->default(now());
            $table->string('TimeSlot', 50)->nullable();
            $table->integer('NumberGuests')->nullable();
            $table->integer('PrePayment')->nullable();

            $table->unsignedInteger('IdStatus');

            $table->boolean('isActive')->default(true);
            $table->string('Note', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_Booking');
    }
};
