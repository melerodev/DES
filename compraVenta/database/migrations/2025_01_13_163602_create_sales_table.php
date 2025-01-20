<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
        

        // Insertar algunas categorías en la tabla categories
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Electrónica'],
            ['id' => 2, 'name' => 'Deportes'],
            ['id' => 3, 'name' => 'Hogar'],
            ['id' => 4, 'name' => 'Moda'],
            ['id' => 5, 'name' => 'Juguetes'],
            ['id' => 6, 'name' => 'Coches'],
            ['id' => 7, 'name' => 'Libros'],
            ['id' => 8, 'name' => 'Música'],
            ['id' => 9, 'name' => 'Videojuegos'],
            ['id' => 10, 'name' => 'Otros'],
        ]);
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
