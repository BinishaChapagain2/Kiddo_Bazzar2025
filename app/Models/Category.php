<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['priority', 'name', 'photopath'];


    // has many relationship with product
    public function products()
    {
        return $this->hasMany(Product::class)->where('status', 'show');
    }

    // has one relationship with banner
    public function banners()
    {
        return $this->hasMany(Banner::class);
    }
}
