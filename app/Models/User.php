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
        'is_admin',
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

    // methods

    public function monthlyEarnings($month)
    {
        $collaborations = $this->collaborations()->get();
        $payed_month = $collaborations->filter(fn ($item) => $item->completed_date?->month == $month && $item->payed_at)->sum('price');
        $refund_month = Claim::whereHas('collaboration', function ($q) {
            $q->where('user_id', $this->id);
        })
            ->whereMonth('created_at', $month)
            ->get('refund')->sum('refund');

        return number_format(($payed_month - $refund_month), 2);
    }
    
    public function totalEarnings()
    {
        $collaborations = $this->collaborations()->get();
        $payed = $collaborations->filter(fn ($item) => $item->payed_at)->sum('price');
        $refund = Claim::whereHas('collaboration', function ($q) {
            $q->where('user_id', $this->id);
        })->get('refund')->sum('refund');

        return number_format(($payed - $refund), 2);
    }

    public function collaborationsWithMoneyLocked()
    {
        $collaborations = $this->collaborations()->get();
        return $collaborations->filter(fn ($item) => $item->completed_date && !$item->payed_at)->values();
    }

    public function moneyLocked()
    {
        $total = $this->collaborationsWithMoneyLocked()->sum('price');
        return number_format($total, 2);
    }

    public function claims()
    {
        return Claim::whereHas('collaboration.homework', function ($q) {
            $q->where('user_id', $this->id);
        })->get();
    }
    
    public function canceledCollaborations()
    {
        return $this->collaborations()->whereNotNull('canceled_at')->whereNotNull('cancel_reason')->get();
    }
}
