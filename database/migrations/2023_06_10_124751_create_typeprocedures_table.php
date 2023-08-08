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
        Schema::create('typeprocedures', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->foreignUuid('area_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignUuid('category_id')->nullable()->constrained()->onDelete('set null');
            $table->string('price')->nullable()->default(0.00);
            $table->string('state')->default("activo");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('typeprocedures');
    }
};
