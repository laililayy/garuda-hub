<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            // Relasi ke user yang membuat proyek (klien)
            $table->foreignId('client_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('title');
            $table->text('description');
            $table->string('category');
            $table->decimal('budget_min', 15, 2);
            $table->decimal('budget_max', 15, 2);
            $table->date('deadline');
            $table->string('status')->default('open');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
