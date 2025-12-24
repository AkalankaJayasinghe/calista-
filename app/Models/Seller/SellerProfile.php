<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'postal_code',
        'country',
        'bank_name',
        'bank_account_name',
        'bank_account_number',
        'bank_branch',
        'payment_methods',
        'shipping_methods',
        'return_policy',
        'terms_and_conditions',
        'about_us',
        'social_facebook',
        'social_instagram',
        'social_twitter',
        'social_linkedin',
    ];

    protected $casts = [
        'payment_methods' => 'array',
        'shipping_methods' => 'array',
    ];

    /**
     * Relationships
     */
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    /**
     * Accessors
     */
    public function getFullAddressAttribute()
    {
        $parts = array_filter([
            $this->address_line_1,
            $this->address_line_2,
            $this->city,
            $this->state,
            $this->postal_code,
            $this->country,
        ]);

        return implode(', ', $parts);
    }
}
