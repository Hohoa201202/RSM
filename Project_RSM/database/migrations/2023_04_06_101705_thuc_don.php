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
        Schema::create('tbl_Menus', function (Blueprint $table) {
            $table->increments('IdMenu');
            $table->string('MenuName', 50);
            $table->string('OrderMenu', 50)->nullable();
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
        Schema::dropIfExists('tbl_Menus');
    }
};
