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
        Schema::create('tbl_Menus_Items', function (Blueprint $table) {
            $table->increments('Id');
            $table->unsignedInteger('IdMenu');
            $table->foreign('IdMenu')
                ->references('IdMenu')
                ->on('tbl_Menus');

            $table->unsignedInteger('IdItems');
            $table->foreign('IdItems')
                ->references('IdItems')
                ->on('tbl_Items');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_Menus_Items');
    }
};
