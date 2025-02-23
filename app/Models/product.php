<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'age_range',
        'size',
        'discounted_price',
        'stock',
        'category_id',
        'brand',
        'product_type',
        'season',
        'photopath',
        'status',
    ];

    // Define relationship: a product can have many reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Method to calculate the average rating
    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }

    public function category()
    {

        return $this->belongsTo(Category::class);
    }

    //cart relation
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}
