<?php
namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'barcode',
        'short_description',
        'price',
        'mrp',
        'purchase_price',
        'quantity',
        'minimum_stock',
        'weight',
        'unit',
        'image',
        'gallery',
        'description',
        'is_featured',
        'is_best_seller',
        'status',
        'is_offer',

        'offer_price',

        'offer_end_date',

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function getImageUrlAttribute()
    {
        if ($this->image && file_exists(public_path('assets/images/products/' . $this->image))) {
            return asset('assets/images/products/' . $this->image);
        }

        return asset('assets/images/no-image.png');
    }
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

}
