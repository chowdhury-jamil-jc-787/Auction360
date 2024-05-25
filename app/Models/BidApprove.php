<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidApprove extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function settimer()
    {
        return $this->belongsTo(SetTimer::class, 'settimers_id');
    }
}
