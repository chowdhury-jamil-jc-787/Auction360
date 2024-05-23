<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes; // Add SoftDeletes trait

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

        /**
     * Get the bids for the category.
     */
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
}
