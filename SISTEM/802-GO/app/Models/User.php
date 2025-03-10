<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'age',
        'birthdate',
        'block_street',
        'barangay',
        'district',
        'city',
        'civil_status',
        'religion',
        'valid_id',
        'email',
        'password',
        'is_admin',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'birthdate' => 'date',
        'is_admin' => 'boolean',
        'last_login_at' => 'datetime',
    ];

    /**
     * Get the full name of the user.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }

    /**
     * Check if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return (bool) $this->is_admin;
    }

    /**
     * Get the complete address of the user.
     *
     * @return string
     */
    public function getCompleteAddressAttribute()
    {
        return "{$this->block_street}, {$this->barangay}, {$this->district}, {$this->city}";
    }

    /**
     * Get the document requests of the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documentRequests()
    {
        return $this->hasMany(DocumentRequest::class);
    }
}
