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
        Schema::create('coche', function (Blueprint $table) {
            $table->id();
            $table->string('marca', 40);
            $table->string('modelo', 50);
            $table->decimal('precio', 9, 2); // Cambiado a decimal
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coche');
    }
};
