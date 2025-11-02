<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'minutes',
        'completed',
        'user_id',
        'ended_at', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
