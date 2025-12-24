<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo para representar o Inventário (Inventory) no sistema.
 * Esta é uma tabela pivô com chave composta (warehouse_id, product_id) para rastrear a quantidade de produtos em armazéns.
 */
class Inventory extends Model
{
    use HasFactory;

    /**
     * Campos que podem ser preenchidos em massa (mass assignment).
     * Inclui warehouse_id, product_id e quantity para gerenciar estoques.
     *
     * @var array
     */
    protected $fillable = ['warehouse_id', 'product_id', 'quantity'];

    /**
     * Chave primária é o campo 'id' auto-increment.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Habilita o auto-incremento.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Relacionamento: Um inventário pertence a um armazém.
     * Permite acessar o armazém associado a este registro de estoque.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    /**
     * Relacionamento: Um inventário pertence a um produto.
     * Permite acessar o produto associado a este registro de estoque.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
