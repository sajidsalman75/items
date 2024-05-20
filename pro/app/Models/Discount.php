<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = ['price', 'item_id'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
