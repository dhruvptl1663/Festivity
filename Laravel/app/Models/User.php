<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public $timestamps = false;

    protected $hidden = [
        'password',
    ];

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'user_id');
    }

    // User has many bookmarks
    public function bookmarks()
    {
        return $this->hasMany(\App\Models\Bookmark::class, 'user_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id', 'user_id');
    }
}
