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
        Schema::create('dm_tbl_Area', function (Blueprint $table) {
            $table->increments('IdArea');
            $table->string('AreaName', 100);
            $table->unsignedInteger('IdBranch');
            $table->foreign('IdBranch')
                ->references('IdBranch')
                ->on('dm_tbl_Branchs');
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
        Schema::dropIfExists('dm_tbl_Area');
    }
};
