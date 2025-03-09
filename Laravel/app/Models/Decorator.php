<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Use Authenticatable for decorators

class Decorator extends Authenticatable
{
    use HasFactory;

    protected $table = 'decorators';

    protected $primaryKey = 'decorator_id';

    protected $fillable = [
        'decorator_name',
        'decorator_icon',
        'email',
        'password',
        'rating',
        'availability',
    ];

    public $timestamps = false;

    protected $hidden = [
        'password',
    ];

    public function events()
    {
        return $this->hasMany(Event::class, 'decorator_id');
    }

    public function packages()
    {
        return $this->hasMany(Package::class, 'decorator_id');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'decorator_id');
    }
}
