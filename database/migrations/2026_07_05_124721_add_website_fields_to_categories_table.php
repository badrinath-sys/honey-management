<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {

            $table->string('slug')->nullable()->after('name');

            $table->string('image')->nullable()->after('description');

            $table->integer('sort_order')->default(0)->after('status');

        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {

            $table->dropColumn([
                'slug',
                'image',
                'sort_order',
            ]);

        });
    }
};
