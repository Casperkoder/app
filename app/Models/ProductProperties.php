<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductProperties extends Model
{
    use HasFactory;
    protected $table='products_properties';
    public $timestamps =false;
    protected $fillable = ['product_id', 'property_id', 'property_value'];
}
