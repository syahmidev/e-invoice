<?php

namespace App\Models;

use App\Models\Item;
use App\Models\Buyer;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'serial_no',
        'invoice_date',
        'order_number',
        'currency',
        'notes',
        'due_date',
        'status',
        'sellers_id',
        'buyers_id'
    ];

    // Relationship
    public function seller()
    {
        return $this->hasOne(Seller::class, 'id');
    }

    public function buyer()
    {
        return $this->hasOne(Buyer::class, 'id');
    }

    public function item()
    {
        return $this->hasMany(Item::class, 'id');
    }
}
