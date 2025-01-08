<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    // Define the fillable properties of the Banner model
    protected $fillable = [
        'priority',
        'name',
        'photopath',
        'description',
        'category_id',
        'buttonaction',
    ];

    // Define a relationship with the Category model (one-to-many)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
