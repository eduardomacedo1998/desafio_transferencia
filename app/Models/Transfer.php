<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo para representar uma Transferência (Transfer) no sistema.
 * Registra o histórico de movimentação de produtos entre armazéns, incluindo status e usuário responsável.
 */
class Transfer extends Model
{
    use HasFactory;

    /**
     * Campos que podem ser preenchidos em massa (mass assignment).
     * Inclui todos os campos necessários para criar e atualizar transferências.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'source_warehouse_id', 'destination_warehouse_id', 'quantity', 'user_id', 'status'];

    /**
     * Relacionamento: Uma transferência pertence a um produto.
     * Permite acessar o produto sendo transferido.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relacionamento: Uma transferência tem um armazém de origem.
     * Permite acessar o armazém de onde o produto está saindo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sourceWarehouse()
    {
        return $this->belongsTo(Warehouse::class, 'source_warehouse_id');
    }

    /**
     * Relacionamento: Uma transferência tem um armazém de destino.
     * Permite acessar o armazém para onde o produto está indo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destinationWarehouse()
    {
        return $this->belongsTo(Warehouse::class, 'destination_warehouse_id');
    }

    /**
     * Relacionamento: Uma transferência pode pertencer a um usuário (opcional).
     * Permite acessar o usuário que iniciou a transferência para auditoria.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusMessage($status)
    {
        $mensages = [
            'pending' => 'Pendente',
            'completed' => 'Concluído',
            'canceled' => 'Cancelado',
        ];

        return $mensages[$this->status] ?? $this->status;
    }
}

