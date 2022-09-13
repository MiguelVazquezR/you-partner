<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'academic_grade',
        'school_name',
        'state',
        'birthdate',
        'level_id',
        'active',
        'description',
    ];

    protected $dates = [
        'birthdate'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // Relationships -------------------
    public function chats()
    {
        return $this->belongsToMany(Chat::class);
    }
    
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    
    public function homeworks()
    {
        return $this->hasMany(Homework::class);
    }

    public function collaborations()
    {
        return $this->hasMany(Collaboration::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
    public function vouchers()
    {
        return $this->hasMany(Vouchers::class);
    }
}
