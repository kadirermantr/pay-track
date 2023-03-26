<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'stock',
        'category_id',
        'showcase_id',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'pivot',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function showcase(): BelongsTo
    {
        return $this->belongsTo(Showcase::class);
    }
}
