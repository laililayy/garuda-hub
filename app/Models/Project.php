<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'client_id',
        'title',
        'description',
        'category',
        'budget_min',
        'budget_max',
        'deadline',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'budget_min' => 'decimal:2',
            'budget_max' => 'decimal:2',
            'deadline' => 'date',
        ];
    }

    // Proyek dimiliki oleh satu klien
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    // Proyek dapat memiliki banyak penawaran
    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class);
    }
}