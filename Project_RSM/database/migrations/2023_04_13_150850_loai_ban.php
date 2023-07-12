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
        Schema::create('dm_tbl_TableType', function (Blueprint $table) {
            $table->increments('IdType');
            $table->string('TypeName');
            $table->integer('MaxSeats');
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
        Schema::dropIfExists('dm_tbl_TableType');
    }
};
