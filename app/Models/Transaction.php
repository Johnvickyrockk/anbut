<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email',
        'phone',
        'address',
        'color_type',
        'cleaning_service',
        'cleaning_price',
        'repaint_service',
        'repaint_price',
        'pickup_delivery',
        'pickup_delivery_price',
        'total_amount',
        'notes',
        'status',
    ];

    /**
     * Relasi ke model User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Review
     */
    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
