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
        Schema::create('tbl_Customer', function (Blueprint $table) {
            $table->increments('IdCustomer');
            $table->string('UserName', 50)->nullable();
            $table->string('PassWord', 50)->nullable();
            $table->string('LastName', 50);
            $table->string('FirstName', 50);
            $table->boolean('Gender')->default(1);
            $table->string('Avatar', 50)->default('default.png');
            $table->string('PhoneNumber', 10)->nullable();
            $table->string('Email', 50)->nullable();
            $table->string('Province', 50)->nullable();
            $table->string('District', 50)->nullable();
            $table->string('Ward', 50)->nullable();
            $table->string('Address', 50)->nullable();
            $table->dateTime('LastLogin')->default(now());
            $table->boolean('isActive')->default(true);
            $table->string('Description', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_Customer');
    }
};
