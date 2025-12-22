<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo para representar um Produto (Product) no sistema.
 * Um produto pode ter múltiplos inventários em diferentes armazéns e transferências associadas.
 */
class Product extends Model
{
    use HasFactory;

    /**
     * Campos que podem ser preenchidos em massa (mass assignment).
     * Inclui 'name' e 'sku' para criação e atualização segura de produtos.
     *
     * @var array
     */
    protected $fillable = ['name', 'sku'];

    /**
     * Relacionamento: Um produto possui muitos inventários.
     * Permite acessar os registros de estoque deste produto em vários armazéns.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    /**
     * Relacionamento: Um produto pode estar envolvido em muitas transferências.
     * Permite acessar todas as transferências relacionadas a este produto.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }
}
