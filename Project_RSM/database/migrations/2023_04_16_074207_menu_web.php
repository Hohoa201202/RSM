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
        Schema::create('ht_tbl_MenuWeb', function (Blueprint $table) {
            $table->increments('IdMenu');
            $table->string('MenuName', 50);
            $table->string('ControllerName', 50)->nullable();
            $table->string('ActionName', 50)->nullable();
            $table->integer('Lever')->nullable();
            $table->integer('ParentId')->nullable();
            $table->integer('Position')->nullable();
            $table->integer('Order')->nullable();
            $table->string('UserCreated', 50)->nullable();
            $table->string('UserEdit', 50)->nullable();
            $table->string('Icon', 50)->nullable();
            $table->boolean('isActive')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ht_tbl_MenuWeb');
    }
};
