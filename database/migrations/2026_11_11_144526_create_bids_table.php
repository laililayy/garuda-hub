<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->id();

            // Relasi ke proyek yang ditawar
            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            // Relasi ke developer yang mengajukan penawaran
            $table->foreignId('developer_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->decimal('price', 15, 2);
            $table->unsignedInteger('duration');
            $table->text('proposal');
            $table->boolean('is_winner')->default(false);

            // Satu developer hanya boleh bid sekali per proyek
            $table->unique(['project_id', 'developer_id']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};
