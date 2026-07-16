<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'profile_photo_path',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the pet owner profile linked to this user.
     */
    public function owner()
    {
        return $this->hasOne(Owner::class, 'user_id');
    }

    /**
     * Generate initials for users without a profile picture.
     *
     * Example:
     * Jonathan Kigozi becomes JK.
     */
    public function getInitialsAttribute(): string
    {
        return collect(explode(' ', trim($this->name)))
            ->filter()
            ->take(2)
            ->map(function ($word) {
                return strtoupper(substr($word, 0, 1));
            })
            ->implode('');
    }

    /**
     * Return the profile picture URL or null.
     */
    public function getProfilePhotoUrlAttribute(): ?string
    {
        if (!$this->profile_photo_path) {
            return null;
        }

        return asset('storage/' . $this->profile_photo_path);
    }
}