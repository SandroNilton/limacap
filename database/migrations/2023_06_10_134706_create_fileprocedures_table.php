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
        Schema::create('fileprocedures', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('procedure_id');
            $table->string('requirement_id');
            $table->string('name');
            $table->string('file');
            $table->string('state')->default("Sin verificar");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fileprocedures');
    }
};
