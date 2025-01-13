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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');
            $table->string('product');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->boolean('issold')->default(false);
            $table->string('image')->nullable(); // Miniatura
            $table->timestamps();
        });
        
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre personalizado
            $table->integer('maxfiles'); // Número de archivos máximo
        });
        
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_id');
            $table->string('route'); // Ruta de la imagen
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('images');
    }
};
