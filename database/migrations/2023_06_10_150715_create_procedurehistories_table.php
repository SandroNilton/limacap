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
        Schema::create('procedurehistories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('procedure_id');
            $table->string('area_id');
            $table->string('admin_id');
            $table->longText('action');
            $table->string('state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procedurehistories');
    }
};
