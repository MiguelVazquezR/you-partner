<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaboration extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment',
        'tax',
        'status',
        'closed_at',
        'user_id',
        'homework_id'
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

    /**
     * Get all of the collaboration's resources.
     */
    public function resourceable()
    {
        return $this->morphMany(Resource::class, 'resourceable');
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
}
