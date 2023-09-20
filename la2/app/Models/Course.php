<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function user() // user() is the name of the column in the courses table
    {
        return $this->belongsTo(User::class, 'user', 'username');
    }
}
