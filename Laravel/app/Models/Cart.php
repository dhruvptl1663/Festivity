<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Event;
use App\Models\Package;
use App\Models\Decorator;

class Cart extends Model
{
    protected $table = 'carts';
    
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'user_id',
        'event_id',
        'package_id',
        'decorator_id',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function decorator()
    {
        return $this->belongsTo(Decorator::class, 'decorator_id');
    }

}
