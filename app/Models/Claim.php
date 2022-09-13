<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'refund',
        'collaboration_id',
        'description',
        'solution_details',
        'solution',
    ];

     // Relationships -------------------
     public function collaboration()
     {
         return $this->belongsTo(Collaboration::class);
     }

}
