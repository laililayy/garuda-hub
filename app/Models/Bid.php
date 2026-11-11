<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bid extends Model
{
    protected $fillable = [
        'project_id',
        'developer_id',
        'price',
        'duration',
        'proposal',
        'is_winner',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'duration' => 'integer',
            'is_winner' => 'boolean',
        ];
    }

    // Penawaran dimiliki oleh satu proyek
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // Penawaran dibuat oleh satu developer
    public function developer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'developer_id');
    }
}