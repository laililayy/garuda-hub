<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('projects')
            ->whereIn('status', ['open', 'terbuka'])
            ->update(['status' => 'terbuka']);

        DB::table('projects')
            ->whereIn('status', ['closed', 'completed', 'ditutup'])
            ->update(['status' => 'ditutup']);

        DB::statement("
            ALTER TABLE projects
            MODIFY status VARCHAR(255) NOT NULL DEFAULT 'terbuka'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE projects
            MODIFY status VARCHAR(255) NOT NULL DEFAULT 'open'
        ");
    }
};