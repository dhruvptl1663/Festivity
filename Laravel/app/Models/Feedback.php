<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public $timestamps = false;

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value);
    }

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
