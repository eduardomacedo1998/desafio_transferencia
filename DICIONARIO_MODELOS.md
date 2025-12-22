# 📚 Dicionário de Termos dos Modelos Laravel

Este documento serve como um glossário para entender os termos e conceitos utilizados nos modelos Eloquent do Laravel no projeto de gerenciamento de estoque. Explicamos cada termo com definições, exemplos e contexto prático, baseado nos modelos criados (Warehouse, Product, Inventory, Transfer).

## 🏗️ Estrutura Básica de um Modelo

### Modelo (Model)
- **Definição**: Uma classe PHP que representa uma tabela do banco de dados. No Laravel, os modelos Eloquent permitem interagir com o banco de forma orientada a objetos.
- **Exemplo**: `class Warehouse extends Model` - Representa a tabela `warehouses`.
- **Uso**: Permite criar, ler, atualizar e deletar registros (CRUD) sem escrever SQL diretamente.

### Namespace
- **Definição**: Organiza classes em "pastas virtuais" para evitar conflitos de nomes.
- **Exemplo**: `namespace App\Models;` - Indica que a classe está em `app/Models/`.
- **Uso**: Essencial para autoloading e organização do código.

### Trait
- **Definição**: Um mecanismo de reutilização de código em PHP. Adiciona funcionalidades a uma classe sem herança.
- **Exemplo**: `use HasFactory;` - Permite criar "fábricas" para gerar dados de teste.
- **Uso**: `HasFactory` facilita a criação de instâncias do modelo em testes ou seeds.

## 🔧 Propriedades dos Modelos

### $fillable
- **Definição**: Array que define quais campos podem ser preenchidos em massa (mass assignment) para proteger contra vulnerabilidades.
- **Exemplo**: `protected $fillable = ['name'];` no Warehouse - Só permite atribuir 'name' diretamente.
- **Uso**: Evita ataques como Mass Assignment. Campos não listados precisam ser atribuídos individualmente.

### $primaryKey
- **Definição**: Define a chave primária da tabela. Por padrão, é 'id', mas pode ser customizada.
- **Exemplo**: `protected $primaryKey = ['warehouse_id', 'product_id'];` no Inventory - Chave composta.
- **Uso**: Essencial para tabelas com chaves primárias não convencionais.

### $incrementing
- **Definição**: Booleano que indica se a chave primária é auto-incrementada.
- **Exemplo**: `public $incrementing = false;` no Inventory - Desabilita auto-incremento para chave composta.
- **Uso**: Necessário quando a chave primária não é um inteiro único.

## 🔗 Relacionamentos (Relationships)

Os relacionamentos permitem conectar modelos entre si, facilitando consultas complexas.

### hasMany
- **Definição**: Relacionamento "um para muitos". Um registro possui muitos registros relacionados.
- **Exemplo**: `return $this->hasMany(Inventory::class);` no Warehouse - Um armazém tem muitos inventários.
- **Uso**: Acessa dados relacionados, ex.: `$warehouse->inventories` retorna todos os estoques do armazém.

### belongsTo
- **Definição**: Relacionamento "muitos para um". Muitos registros pertencem a um registro pai.
- **Exemplo**: `return $this->belongsTo(Warehouse::class);` no Inventory - Um inventário pertence a um armazém.
- **Uso**: Navega para o pai, ex.: `$inventory->warehouse` retorna o armazém associado.

### belongsTo (com chave estrangeira customizada)
- **Definição**: Mesmo que belongsTo, mas especifica a coluna da chave estrangeira.
- **Exemplo**: `return $this->belongsTo(Warehouse::class, 'source_warehouse_id');` no Transfer - Especifica 'source_warehouse_id' como FK.
- **Uso**: Quando a FK não segue a convenção padrão (nome_do_modelo_id).

## 📝 Convenções e Boas Práticas

### Convenção de Nomes
- **Tabelas**: Plural (warehouses, products).
- **Modelos**: Singular com PascalCase (Warehouse, Product).
- **Chaves Estrangeiras**: nome_da_tabela_singular_id (warehouse_id).

### PHPDoc
- **Definição**: Comentários especiais para documentar código, visíveis em IDEs.
- **Exemplo**: `/** @return \Illuminate\Database\Eloquent\Relations\HasMany */` - Indica o tipo de retorno.
- **Uso**: Melhora a legibilidade e ajuda ferramentas de autocompletar.

### Transações e Segurança
- **Mass Assignment Protection**: Use $fillable para controlar atribuições.
- **Relacionamentos**: Definem como os dados se conectam, evitando queries manuais.

## 📋 Exemplos Práticos

### Criando um Armazém
```php
$warehouse = Warehouse::create(['name' => 'Armazém Central']);
```

### Acessando Relacionamentos
```php
// Inventários de um armazém
$inventories = $warehouse->inventories;

// Produto de um inventário
$product = $inventory->product;

// Transferências de origem de um armazém
$transfers = $warehouse->sourceTransfers;
```

### Chave Composta no Inventory
- Como a tabela Inventory usa chave composta, operações como `find()` precisam de array:
```php
$inventory = Inventory::find(['warehouse_id' => 1, 'product_id' => 5]);
```

Este dicionário cobre os principais termos dos modelos. Para mais detalhes, consulte a [documentação oficial do Laravel](https://laravel.com/docs/eloquent).</content>
<parameter name="filePath">c:\xampp\htdocs\teste\desafio_transferencia\DICIONARIO_MODELOS.md