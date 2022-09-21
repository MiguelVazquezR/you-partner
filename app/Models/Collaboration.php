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

    // accessors and mutators


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
}
