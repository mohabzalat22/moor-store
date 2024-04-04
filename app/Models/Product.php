<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'quantity',
        'color',
        'description',
        'shipping_info',
        'currency_type',
        'price',
        'discount',
    ];

    public function sizes(): hasMany
    {
        return $this->hasMany(Size::class);
    }
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
