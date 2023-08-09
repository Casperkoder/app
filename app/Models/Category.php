<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    // ORM bire cok ilişki
    public function properties()
    {
        return $this->hasMany(Property::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
