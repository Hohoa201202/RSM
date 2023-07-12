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
        Schema::create('tbl_res_info', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('ResName', 255);
            $table->string('Hotline1', 15);
            $table->string('Hotline2', 15);
            $table->string('Email', 255);
            $table->string('Logo', 255);
            $table->string('OpeningDay', 20);
            $table->time('OpenTime');
            $table->time('CloseTime');
            $table->string('ShortDescription', 255);
            $table->text('LongDescription');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_res_info');
    }
};
