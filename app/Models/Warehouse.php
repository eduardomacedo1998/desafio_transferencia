<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function sourceTransfers()
    {
        return $this->hasMany(Transfer::class, 'source_warehouse_id');
    }

    public function destinationTransfers()
    {
        return $this->hasMany(Transfer::class, 'destination_warehouse_id');
    }
}
