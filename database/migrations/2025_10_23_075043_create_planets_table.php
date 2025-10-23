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
        Schema::create('planets', function (Blueprint $table) {
            $table->id();
            // i18n côté public
            $table->string('name_fr');
            $table->string('name_en');
            $table->text('description_fr');
            $table->text('description_en');

            // données affichées
            $table->string('image')->nullable(); // storage/app/public/planets/...
            $table->string('distance');          // ex: "225 M km"
            $table->string('duration');          // ex: "9 months"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planets');
    }
};
