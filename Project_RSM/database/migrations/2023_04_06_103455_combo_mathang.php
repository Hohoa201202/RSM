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
        Schema::create('tbl_Combo_Items', function (Blueprint $table) {
            $table->increments('Id');
            $table->unsignedInteger('IdCombo');
            $table->foreign('IdCombo')
                ->references('IdCombo')
                ->on('tbl_Combo');

            $table->unsignedInteger('IdItems');
            $table->foreign('IdItems')
                ->references('IdItems')
                ->on('tbl_Items');

            $table->float('Quantity', 5, 2);
            $table->boolean('isActive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_Combo_Items');
    }
};
