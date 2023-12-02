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
        Schema::create('procedures', function (Blueprint $table) {
            //$table->uuid('id')->primary();
            $table->string('id',36)->primary();
            $table->foreignUuid('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignUuid('area_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignUuid('typeprocedure_id')->nullable()->constrained()->onDelete('set null');
            $table->string('admin_id')->nullable();
            $table->longText('description')->nullable();
            $table->dateTime('date');
            $table->tinyInteger('state')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procedures');
    }
};
