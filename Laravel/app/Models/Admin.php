<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Use Authenticatable for admins

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins';

    protected $primaryKey = 'admin_id';

    protected $fillable = [
        'name',
        'email',
        'password_hash',
    ];

    public $timestamps = false; //to prevent error with timestamps column

    protected $hidden = [
        'password_hash',
    ];
}
