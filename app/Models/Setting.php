<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [

        'company_name',

        'owner_name',

        'logo',

        'phone',

        'email',

        'website',

        'gst',

        'pan_number',

        'address',

        'bank_name',

        'account_name',

        'account_number',

        'ifsc',

        'branch',

        'upi_id',

        'upi_qr',

        'signature',

        'terms',

    ];

}
