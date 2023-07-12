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
        Schema::create('tbl_OrderDetails', function (Blueprint $table) {
            $table->increments('Id');

            $table->unsignedInteger('IdOrder');
            $table->foreign('IdOrder')
                ->references('IdOrder')
                ->on('tbl_Orders');

            $table->unsignedInteger('IdItems')->nullable();
            $table->unsignedInteger('IdCombo')->nullable();

            $table->integer('Quantity')->default(1);
            $table->integer('PriceSale')->default(0);
            $table->integer('Amount')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_OrderDetails');
    }
};
