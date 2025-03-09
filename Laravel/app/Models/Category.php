<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories'; // Optional: If your table name is different

    protected $primaryKey = 'category_id'; //Optional: If your primary key is different

    protected $fillable = [
        'category_name',
        'description',
    ];

    public $timestamps = false; //to prevent error with timestamps column

    public function events()
    {
        return $this->hasMany(Event::class, 'category_id');
    }
}
