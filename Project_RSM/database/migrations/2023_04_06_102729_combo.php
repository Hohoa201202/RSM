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
        Schema::create('tbl_Combo', function (Blueprint $table) {
            $table->increments('IdCombo');
            $table->string('ComboName', 50);
            $table->integer('CostPrice');
            $table->integer('Price');
            $table->string('Avatar', 50)->default('default.png');
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
        Schema::dropIfExists('tbl_Combo');
    }
};
