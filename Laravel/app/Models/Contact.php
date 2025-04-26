<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'image',
    ];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset($this->image);
        }
        return null;
    }
}
