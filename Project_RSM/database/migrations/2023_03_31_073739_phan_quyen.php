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
        Schema::create('ht_tbl_Role', function (Blueprint $table) {
            $table->increments('IdRole');

            $table->unsignedInteger('IdGroup');

            $table->unsignedInteger('IdMenuAdmin');

            $table->string('Description', 255)->nullable();
            $table->timestamps();

            $table->unique(['IdGroup', 'IdMenuAdmin']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ht_tbl_Role');
    }
};
