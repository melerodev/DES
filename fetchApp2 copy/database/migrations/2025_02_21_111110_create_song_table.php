<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('route_image');
            $table->string('route_song');
            $table->string('artist');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        DB::table('categories')->insert([
            ['name' => 'Rock'],
            ['name' => 'Pop'],
            ['name' => 'Jazz'],
        ]);

        // Insertar datos en la tabla songs
        DB::table('songs')->insert([
            ['title' => 'Bohemian Rhapsody', 'route_image' => 'default.webp', 'route_song' => 'default.mp3', 'artist' => 'Queen', 'category_id' => 1],
            ['title' => 'Billie Jean', 'route_image' => 'default.webp', 'route_song' => 'default.mp3', 'artist' => 'Michael Jackson', 'category_id' => 2],
            ['title' => 'Take Five', 'route_image' => 'default.webp', 'route_song' => 'default.mp3', 'artist' => 'Dave Brubeck', 'category_id' => 3],
        ]);
    }

    public function down(): void {
        Schema::dropIfExists('songs');
        Schema::dropIfExists('categories');
    }
};