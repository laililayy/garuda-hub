<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Proyek yang dibuat oleh klien
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'client_id');
    }

    // Penawaran yang dibuat developer
    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class, 'developer_id');
    }

    // Rating yang diberikan klien
    public function givenRatings(): HasMany
    {
        return $this->hasMany(Rating::class, 'client_id');
    }

    // Rating yang diterima developer
    public function receivedRatings(): HasMany
    {
        return $this->hasMany(Rating::class, 'developer_id');
    }

    // Penawaran yang berhasil dimenangkan developer
    public function winningBids(): HasMany
    {
        return $this->hasMany(Bid::class, 'developer_id')
            ->where('is_winner', true);
    }
}