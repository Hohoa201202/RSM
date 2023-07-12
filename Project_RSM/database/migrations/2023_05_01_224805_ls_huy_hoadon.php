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
        Schema::create('tbl_CancelledOrder', function (Blueprint $table) {
            $table->increments('Id');

            $table->unsignedInteger('IdOrder');
            $table->foreign('IdOrder')
                ->references('IdOrder')
                ->on('tbl_Orders');

            $table->string('CancellationReason', 255); //Lý do hủy
            $table->dateTime('CancellationDate'); //Thời gian hủy

            $table->unsignedInteger('CancelledBy'); //Người hủy
            $table->foreign('CancelledBy')
                ->references('IdUser')
                ->on('tbl_user');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_CancelledOrder');
    }
};
