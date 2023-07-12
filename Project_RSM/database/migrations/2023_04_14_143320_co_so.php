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
        Schema::create('dm_tbl_Branchs', function (Blueprint $table) {
            $table->increments('IdBranch');
            $table->string('BranchName', 100);
            $table->string('Address', 255)->nullable();
            $table->string('PhoneNumber', 10)->nullable();
            $table->string('Email', 100)->nullable();
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
        Schema::dropIfExists('dm_tbl_Branchs');
    }
};
