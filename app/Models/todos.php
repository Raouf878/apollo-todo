<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class todos extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'work', 'duedate', 'user_id'];

    // Relationship to associate todo with a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

