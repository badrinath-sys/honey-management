<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {

            $table->decimal('purchase_price', 10, 2)
                ->default(0)
                ->after('mrp');

            $table->integer('minimum_stock')
                ->default(5)
                ->after('quantity');

            $table->boolean('is_featured')
                ->default(false)
                ->after('status');

            $table->boolean('is_best_seller')
                ->default(false)
                ->after('is_featured');

            $table->json('gallery')
                ->nullable()
                ->after('image');

        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

            $table->dropColumn([
                'purchase_price',
                'minimum_stock',
                'is_featured',
                'is_best_seller',
                'gallery',
            ]);

        });
    }
};
