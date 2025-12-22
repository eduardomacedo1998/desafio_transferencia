Desafio Laravel: Gerenciamento de Estoque Distribuído e Transferências
Contexto/História
A empresa de logística "QuickShip" está crescendo rapidamente e opera com múltiplos armazéns espalhados pela cidade. Eles enfrentam problemas sérios na gestão do estoque, especialmente quando precisam mover grandes volumes de produtos de um armazém para outro.

Você foi contratado para construir um módulo de backend no Laravel que gerencie a transferência de itens entre armazéns, garantindo que a quantidade de estoque seja debitada corretamente na origem e creditada no destino, tudo isso de forma segura e transacional.

O sistema deve expor um endpoint de API que gerencie essa movimentação.

Requisitos Técnicos
Você deve utilizar o framework Laravel (versão 8 ou superior) e o banco de dados de sua preferência (SQLite, MySQL, etc.).

1. Estrutura de Modelos e Migrações
Crie os modelos e as migrações necessárias para representar as seguintes entidades e suas relações:

•
**`Warehouse` (Armazém):**

•
`id`

•
`name` (string)

•
**`Product` (Produto):**

•
`id`

•
`name` (string)

•
`sku` (string, unique)

•
**`Inventory` (Estoque):** Esta deve ser a tabela pivô que liga Produtos a Armazéns, rastreando a quantidade.

•
`warehouse_id` (foreign key)

•
`product_id` (foreign key)

•
`quantity` (integer, default 0)

•
*Nota:* Use uma chave composta (`warehouse_id`, `product_id`) para garantir unicidade.

•
**`Transfer` (Transferência):** Registra o histórico da movimentação.

•
`id`

•
`product_id`

•
`source_warehouse_id`

•
`destination_warehouse_id`

•
`quantity` (integer)

•
`user_id` (opcional, mas recomendado para auditoria)

•
`status` (e.g., 'completed', 'failed')

2. Lógica de Negócio: O Serviço de Transferência
Crie um serviço (ou lógica dentro do Controller) que execute a operação de transferência de estoque. Este processo deve ser atômico (ou seja, se falhar em qualquer etapa, deve reverter tudo).

3. Endpoint da API
Crie uma rota de API que aceite requisições `POST` para iniciar uma transferência de estoque.

#### Rota Exemplo:

code snippet
// routes/api.php
Route::post('/inventory/transfer', [InventoryController::class, 'transfer']);
#### Estrutura da Requisição (JSON):

code snippet
{
    "product_id": 15,
    "source_warehouse_id": 1,
    "destination_warehouse_id": 2,
    "quantity": 50
}
4. Implementação Segura
A lógica de transferência deve utilizar o mecanismo de transações do banco de dados do Laravel para garantir integridade.

code snippet
// Exemplo de uso de transação
DB::transaction(function () use ($data) {
    // 1. Validar e buscar estoque
    // 2. Decrementar na origem
    // 3. Incrementar no destino
    // 4. Registrar a Transferência
});
Critérios de Aceitação
Para que o desafio seja considerado completo, todos os critérios abaixo devem ser atendidos:

1. Validação Completa: A requisição deve ser validada rigorosamente (Form Request é incentivado).

•
Todos os IDs de armazém e produto devem existir.

•
A `quantity` deve ser um número inteiro positivo maior que zero.

•
O armazém de origem e o de destino não podem ser o mesmo.

2. Disponibilidade de Estoque (Validação Crítica): A transferência só pode ocorrer se o `source_warehouse_id` tiver estoque suficiente do `product_id` para cobrir a `quantity` solicitada. Se não houver, a transferência deve falhar com um código HTTP 400 (Bad Request) e uma mensagem clara.

3. Atomicidade: A lógica de débito e crédito de estoque deve ser envolvida em uma transação de banco de dados (`DB::transaction`). Se o crédito no destino falhar, o débito na origem deve ser revertido.

4. Atualização de Estoque: Após a transferência bem-sucedida, a tabela `Inventory` deve refletir:

•
Decremento da `quantity` no armazém de origem.

•
Incremento da `quantity` no armazém de destino.

5. Registro de Transferência: A tabela `Transfer` deve registrar o sucesso da operação.

6. Respostas da API: Retornar respostas JSON adequadas:

•
Sucesso: HTTP 201 (Created) ou 200 (OK) com detalhes da transferência.

•
Falha (Validação): HTTP 422 (Unprocessable Entity).

•
Falha (Estoque Insuficiente): HTTP 400 (Bad Request).

Bônus Opcional: Auditoria e Assincronicidade
Se você completou os requisitos principais, implemente o seguinte para demonstrar um conhecimento mais aprofundado do ecossistema Laravel:

Bônus 1: Eventos e Listeners
Em vez de registrar o histórico na tabela `Transfer` diretamente dentro da transação, dispare um Evento (ex: `StockTransferred`) após o sucesso da transação. Crie um Listener para este evento que seja responsável exclusivamente por persistir o registro na tabela `Transfer`.

Bônus 2: Locks Otimistas (Concurrency Control)
Para lidar com possíveis cenários de concorrência onde dois usuários tentam transferir o mesmo item do mesmo armazém simultaneamente, utilize *locks* (bloqueios) do Eloquent ou do Database para garantir que a verificação de estoque e a atualização ocorram de forma segura.

•
**Dica:** Considere usar `lockForUpdate()` no Eloquent ao buscar o registro de inventário de origem dentro da transação.