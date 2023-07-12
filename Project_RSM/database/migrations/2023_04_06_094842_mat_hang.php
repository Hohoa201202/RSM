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
        Schema::create('tbl_Items', function (Blueprint $table) {
            $table->increments('IdItems');
            $table->string('ItemsName', 50);

            $table->unsignedInteger('Unit');
            $table->foreign('Unit')
                ->references('Unit')
                ->on('dm_tbl_Unit');

            $table->unsignedInteger('IdCategory');
            $table->foreign('IdCategory')
                ->references('IdCategory')
                ->on('dm_tbl_Categories');
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
        Schema::dropIfExists('tbl_Items');
    }
};
