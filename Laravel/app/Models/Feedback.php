<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $primaryKey = 'feedback_id';

    protected $fillable = [
        'user_id',
        'event_id',
        'package_id',
        'decorator_id',
        'rating',
        'comment',
    ];

    public $timestamps = false; //to prevent error with timestamps column

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
