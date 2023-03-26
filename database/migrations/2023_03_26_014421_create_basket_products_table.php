<?php

use App\Models\Basket;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('basket_products', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Basket::class)
                ->constrained('baskets')
                ->cascadeOnDelete();

            $table->foreignIdFor(Product::class)
                ->constrained('products')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basket_products');
    }
};
