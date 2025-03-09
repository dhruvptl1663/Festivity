<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageEvent extends Model
{
    use HasFactory;

    protected $table = 'package_events';

    protected $primaryKey = 'package_event_id';

    protected $fillable = [
        'package_id',
        'event_id',
    ];

    public $timestamps = false; //to prevent error with timestamps column

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
