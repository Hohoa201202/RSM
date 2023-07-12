<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_feedback', function (Blueprint $table) {
            $table->increments('Id');

            $table->unsignedInteger('IdCustomer');
            $table->foreign('IdCustomer')
                ->references('IdCustomer')
                ->on('tbl_customer');

            $table->unsignedInteger('IdBooking');
            $table->foreign('IdBooking')
                ->references('IdBooking')
                ->on('tbl_booking');

            $table->integer('NumStars')->default(5);
            $table->string('Content', 255)->nullable();
            $table->boolean('isApproved')->default(false);
            $table->datetime('FeedbackDate')->default(Carbon::now());

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_feedback');
    }
};
