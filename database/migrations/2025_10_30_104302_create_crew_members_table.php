<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('crew_members', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->json('name');        // {"fr":"...","en":"..."}
            $table->json('role_title');  // {"fr":"...","en":"..."}
            $table->json('bio')->nullable();
            $table->string('image')->nullable(); // chemin storage
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crew_members');
    }
};
