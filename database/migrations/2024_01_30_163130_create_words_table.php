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
        Schema::create('words', function (Blueprint $table) {
            $table->id();

            $table->string('word');
            $table->string('ar_translation')->comment('the arabic translation of the word.');
            $table->string('en_translation')->comment('the english translation of the word.');
            $table->foreignId('language_level_id')->constrained('language_levels', 'id');
            $table->foreignId('type_id')->constrained('types', 'id');
            $table->foreignId('user_id')->nullable()->constrained('users', 'id')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('words');
    }
};
