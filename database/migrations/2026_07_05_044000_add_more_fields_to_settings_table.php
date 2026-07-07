<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {

            $table->string('owner_name')->nullable()->after('company_name');

            $table->string('website')->nullable()->after('email');

            $table->string('pan_number')->nullable()->after('gst');

            $table->string('bank_name')->nullable();

            $table->string('account_name')->nullable();

            $table->string('account_number')->nullable();

            $table->string('ifsc')->nullable();

            $table->string('branch')->nullable();

            $table->string('upi_id')->nullable();

            $table->string('upi_qr')->nullable();

            $table->string('signature')->nullable();

            $table->text('terms')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {

            $table->dropColumn([

                'owner_name',

                'website',

                'pan_number',

                'bank_name',

                'account_name',

                'account_number',

                'ifsc',

                'branch',

                'upi_id',

                'upi_qr',

                'signature',

                'terms',

            ]);

        });
    }
};
