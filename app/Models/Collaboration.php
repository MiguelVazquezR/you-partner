<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaboration extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'tax',
        'promise_date',
        'completed_date',
        'approved_at',
        'canceled_at',
        'read_at',
        'payed_at',
        'cancel_reason',
        'completed_comments',
        'user_id',
        'homework_id',
    ];


    protected $dates = [
        'promise_date',
        'completed_date',
        'approved_at',
        'canceled_at',
        'read_at',
        'payed_at',

    ];

    // Relationships -------------------
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function homework()
    {
        return $this->belongsTo(Homework::class);
    }

    public function claim()
    {
        return $this->hasOne(Claim::class);
    }

    // methods
    public function status()
    {
        if (!$this->approved_at) return 1; //waiting approve
        elseif (!$this->completed_date) return 2; //in process
        elseif ($this->claim?->count()) return 4; //claim
        else return 3; //complete
    }

    // query scopes
    public function scopeFilter($query, $filters)
    {
        $query->when($filters["search"], function ($query, $search) {
            $query->where('status', 'LIKE', "%$search%")
                ->orWhere('payment', 'LIKE', "%$search%")
                ->orWhereHas('homework', function ($query2) use ($search) {
                    $query2->where('title', 'LIKE', "%$search%")
                        ->orwhereHas('user', function ($query3) use ($search) {
                            $query3->where('name', 'LIKE', "%$search%");
                        });
                });
        });
    }

    public function scopeNewAppliesTo($query, $user)
    {
        $query->whereNull('read_at')
            ->whereNull('canceled_at')
            ->whereHas('homework', function ($q) use ($user){
                $q->where('user_id', $user);
            });
    }
}
