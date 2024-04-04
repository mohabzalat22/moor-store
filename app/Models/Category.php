<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'category',
        'subcategory'
    ];
    public function product(): HasOne
    {
        return $this->hasOne(Size::class);
    }
}
