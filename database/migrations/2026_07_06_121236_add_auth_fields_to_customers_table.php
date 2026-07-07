<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {

            $table->string('password')->nullable()->after('email');

            $table->string('city')->nullable()->after('address');

            $table->string('state')->nullable()->after('city');

            $table->string('pincode')->nullable()->after('state');

            $table->timestamp('email_verified_at')->nullable();

            $table->rememberToken();

        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {

            $table->dropColumn([
                'password',
                'city',
                'state',
                'pincode',
                'email_verified_at',
                'remember_token',
            ]);

        });
    }
};
