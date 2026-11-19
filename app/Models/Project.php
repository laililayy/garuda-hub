<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'budget_min' => 'decimal:2',
            'budget_max' => 'decimal:2',
            'deadline' => 'date',
            'completed_at' => 'datetime',
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

    // Proyek memiliki satu rating
    public function rating(): HasOne
    {
        return $this->hasOne(Rating::class);
    }
}
