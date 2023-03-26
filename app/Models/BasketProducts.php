<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketProducts extends Model
{
    use HasFactory;

    /**
     * @var bool $timestamps
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'basket_id',
        'product_id',
        'quantity',
        'price',
        'discount_rate',
        'discounted_price',
        'total',
    ];
}
