<?php

namespace App\Models;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'unit',
        'quantity',
        'price',
        'discount',
        'sub_total',
        'invoices_id',
    ];

    // Relationship
    public function invoices()
    {
        return $this->belongsTo(Invoice::class, 'invoices_id');
    }
}
