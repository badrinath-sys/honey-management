<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {

            $table->boolean('is_offer')
                ->default(false)
                ->after('price');

            $table->decimal('offer_price', 10, 2)
                ->nullable()
                ->after('is_offer');

            $table->date('offer_end_date')
                ->nullable()
                ->after('offer_price');

        });
    }
};
