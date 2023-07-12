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
        Schema::create('tbl_Tables', function (Blueprint $table) {
            $table->increments('IdTable');
            $table->string('TableName', 100);

            $table->unsignedInteger('IdType');
            $table->foreign('IdType')
                ->references('IdType')
                ->on('dm_tbl_tabletype');

            $table->unsignedInteger('IdArea');
            $table->foreign('IdArea')
                ->references('IdArea')
                ->on('dm_tbl_Area');

            $table->unsignedInteger('IdStatus');
            $table->foreign('IdStatus')
                ->references('IdStatus')
                ->on('dm_tbl_TableStatus');

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
        Schema::dropIfExists('tbl_Tables');
    }
};
