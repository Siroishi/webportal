<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news_category_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('news_id')->constrained()->onDelete('cascade');
            $table->foreignId('news_category_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['news_id', 'news_category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news_category_relations');
    }
}; 