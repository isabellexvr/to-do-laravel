<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'endsAt', ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    // Define an accessor for formatting the endsAt attribute
    public function getFormattedEndsAtAttribute()
    {
        return $this->endsAt ? $this->endsAt->format('Y-m-d H:i:s') : null;
    }
}
