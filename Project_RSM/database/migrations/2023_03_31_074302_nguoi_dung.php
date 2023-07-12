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
        Schema::create('tbl_User', function (Blueprint $table) {
            $table->increments('IdUser', 50);
            $table->string('UserName', 50);
            $table->unique('Username');
            $table->string('PassWord', 50);
            $table->string('LastName', 50);
            $table->string('FirstName', 50);
            $table->string('Avatar', 50)->default('default.png');
            $table->date('BirthDay')->default(now());
            $table->string('PhoneNumber', 10)->nullable();
            $table->string('Email', 50)->nullable();
            $table->unsignedInteger('IdGroup');
            $table->foreign('IdGroup')
                ->references('IdGroup')
                ->on('ht_tbl_Group');
            $table->dateTime('LastLogin')->default(now());
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
        Schema::dropIfExists('tbl_User');
    }
};
