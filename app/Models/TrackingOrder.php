<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_email',
        'status',
        'message',
        'admin_notes'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function getStatusBadgeAttribute()
    {
        $statuses = [
            'processing' => ['class' => 'bg-warning', 'text' => 'Processing'],
            'shipped' => ['class' => 'bg-info', 'text' => 'Shipped'],
            'delivered' => ['class' => 'bg-success', 'text' => 'Delivered']
        ];

        return $statuses[$this->status] ?? ['class' => 'bg-secondary', 'text' => 'Unknown'];
    }
}