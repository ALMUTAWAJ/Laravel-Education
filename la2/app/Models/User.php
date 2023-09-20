<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'plan_hours',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // defining the relationship with the courses table
    // the following function means that this class which is the user 
    // model class has many courses in the courses table 
    // and the link between them is the column which called user
    // which is a foreign key in the courses table and it is called
    // username in the users table 
    public function userCourses()
    {
        return $this->hasMany(Course::class, 'user', 'username');
    }
}


/*

Before executing the command php artisan migrate, 
I should make sure that I did the following steps correctly.
 

1. I have added the username in users default table and marked it as unique to use it in the authentication later.
2. I have added the the attribute user in the courses table and then I wrote another line indicating it is a foreign key from the table users as follows:  
$table->string('user');  // Add the foreign key column and in next line mark it as foreign key
            $table->foreign('user')->references('username')->on('users');  // (reference is the users table) 

3. I have defined that relationship between courses and users tables by adding a function in the User model indicating that the user can have multiple courses as follows.
   public function userCourses()
    {
        return $this->hasMany(Course::class, 'user', 'username');
    }

4. By the end of step, I can call the courses in the controller of a specific user which has an active session as follows: $courses = -> Auth::user()->uesrCourses;

*/
