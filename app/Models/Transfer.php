<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'source_warehouse_id', 'destination_warehouse_id', 'quantity', 'user_id', 'status'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function sourceWarehouse()
    {
        return $this->belongsTo(Warehouse::class, 'source_warehouse_id');
    }

    public function destinationWarehouse()
    {
        return $this->belongsTo(Warehouse::class, 'destination_warehouse_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
