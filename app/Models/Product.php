<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

//    category ve ürün arasında ters ilişki
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public $timestamps = false;
    protected $fillable = ['category_id', 'name', 'detail', 'price', 'amount'];

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'products_properties')->withPivot('property_value');
    }
}
