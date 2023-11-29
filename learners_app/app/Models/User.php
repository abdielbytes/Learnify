<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'language',
    ];
    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
}

class Course extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'content'
    ];
    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson');
    }
}

class Lesson extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'content',
    ];

    public function exercises()
    {
        return $this->hasMany('App\Models\Exercise');
    }
}

class Exercise extends Model
{
    protected $fillable = [
        'lesson_id',
        'question',
        'answer',
    ];
}

class ProgressTracking extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
        'lesson_id',
        'completion_status',
    ];
}
