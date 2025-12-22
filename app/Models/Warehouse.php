<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo para representar um Armazém (Warehouse) no sistema.
 * Um armazém pode ter múltiplos inventários e transferências associadas.
 */
class Warehouse extends Model
{
    use HasFactory;

    /**
     * Campos que podem ser preenchidos em massa (mass assignment).
     * Apenas o campo 'name' é permitido para evitar vulnerabilidades.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Relacionamento: Um armazém possui muitos inventários.
     * Permite acessar os registros de estoque associados a este armazém.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    /**
     * Relacionamento: Um armazém pode ser a origem de muitas transferências.
     * Permite acessar as transferências onde este armazém é o ponto de partida.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sourceTransfers()
    {
        return $this->hasMany(Transfer::class, 'source_warehouse_id');
    }

    /**
     * Relacionamento: Um armazém pode ser o destino de muitas transferências.
     * Permite acessar as transferências onde este armazém é o ponto de chegada.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function destinationTransfers()
    {
        return $this->hasMany(Transfer::class, 'destination_warehouse_id');
    }
}
