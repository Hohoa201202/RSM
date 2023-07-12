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
        Schema::create('ht_tbl_SlideWeb', function (Blueprint $table) {
            $table->increments('IdSlide');
            $table->unsignedInteger('IdMenu')->nullable();
            $table->string('Title', 100);
            $table->string('SubTitle', 50)->nullable();
            $table->string('ImageName', 50);
            $table->integer('Position')->nullable();
            $table->integer('Order')->nullable();
            $table->boolean('isActive')->default(1);
            $table->string('Description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ht_tbl_SlideWeb');
    }
};
