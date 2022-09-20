<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'limit_date',
        'priority',
        'user_id',
        'school_subject_id'
    ];

    protected $dates = [
        'limit_date'
    ];

    // Relationships -------------------
    public function schoolSubject()
    {
        return $this->belongsTo(SchoolSubject::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function collaboration()
    {
        return $this->hasOne(Collaboration::class);
    }
    
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    // query scopes
    public function scopeFilter($query, $filters)
    {
        $query->when($filters["search"], function($query, $search){
            $query->where('title', 'LIKE', "%$search%")
                ->orWhereHas('schoolSubject', function($query2) use($search){
                    $query2->where('name', 'LIKE', "%$search%");
                })
                ->orWhereHas('user', function($query2) use($search){
                    $query2->where('name', 'LIKE', "%$search%");
                });
        });
    }
}
