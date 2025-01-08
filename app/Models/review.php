<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // Define fillable fields
    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
        'review'
    ];

    // Define relationship: each review belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Define relationship: each review belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
