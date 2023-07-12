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
        Schema::create('tbl_PriceList', function (Blueprint $table) {
            $table->increments('IdPrice');

            $table->unsignedInteger('IdItems');
            $table->foreign('IdItems')
                ->references('IdItems')
                ->on('tbl_Items');

            $table->string('PriceName', 50);
            $table->integer('SalePrice');
            $table->integer('CostPrice');
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
        Schema::dropIfExists('tbl_PriceList');
    }
};
