### Resumo Atualizado dos Padrões a Adotar para o DB

Vamos revisar e expandir o resumo de padrões para o banco de dados, incluindo a distinção para todos os tipos numéricos.

-----

### 1\. Nomenclatura Padrão

A consistência na nomenclatura é vital para a clareza e para o funcionamento suave do seu gerador automático de Models e Entities.

  * **Tabelas:**

      * Use **`snake_case` minúsculo** (ex: `nome_da_tabela`).
      * Utilize o **plural** para nomes de tabelas (ex: `usuarios`, `produtos`, `pedidos`). Seu gerador já converte automaticamente para o singular no nome da Entity.

  * **Colunas (Campos):**

      * Use **`snake_case` minúsculo** (ex: `nome_do_campo`, `data_cadastro`, `preco_unitario`).
      * Nomes de chaves estrangeiras devem seguir a convenção `nome_da_tabela_singular_id` (ex: `usuario_id`, `produto_id`).

-----

### 2\. Tipos de Dados Otimizados e Tratamento PHP

A escolha correta do tipo de dado é crucial para a eficiência do armazenamento e a integridade dos dados, e como ele interage com o PHP.

  * **IDs (Chaves Primárias):**

      * **DB Tipo:** `INTEGER` ou `BIGINT` (se espera muitos registros, acima de 2 bilhões).
      * **Detalhe:** Sempre configure como `AUTOINCREMENT` para que o banco de dados gerencie automaticamente.

  * **Valores Monetários:**

      * **DB Tipo:** Use **`INTEGER` ou `BIGINT`** (dependendo da magnitude dos valores) para armazenar quantias em **centavos** (ou na menor unidade monetária).
      * **Exemplo:** R$ 123,45 deve ser armazenado como `12345`.
      * **Motivo:** Evita os problemas de precisão de ponto flutuante (`FLOAT`, `DECIMAL`) inerentes à representação binária, garantindo cálculos exatos.
      * **Tratamento PHP (via Entity Setters/Getters):**
          * **`set{CampoMonetario}(float|string $value)`:** Recebe `float` ou `string` (com vírgula ou ponto) e converte para `int` (centavos) para salvar.
          * **`get{CampoMonetario}Formatado()`:** Retorna `string` formatada em Real Brasileiro (ex: "R$ 1.234,56").
          * **`get{CampoMonetario}Cents()`:** Retorna o valor `int` em centavos para cálculos internos precisos.

  * **Valores Numéricos (Não Monetários):**

      * **DB Tipo:**
          * **Inteiros:** `INTEGER`, `TINYINT`, `SMALLINT`, `MEDIUMINT`, `BIGINT` (para quantidades, contagens, etc.).
          * **Decimais (com precisão explícita):** `REAL`, `FLOAT`, `DOUBLE` (para números científicos, medidas, etc., onde uma pequena imprecisão é aceitável ou onde a precisão binária é inerente).
      * **Tratamento PHP (via Entity Setters/Getters):**
          * **`set{CampoNumerico}(int|float|string $value)`:** Pode ser gerado para converter strings de entrada (com vírgula decimal, se aplicável) para o tipo numérico correto (`int` ou `float`) antes de atribuir à propriedade.
          * **`get{CampoNumerico}Formatado()`:** Pode retornar uma `string` formatada no padrão brasileiro para exibição (ex: "1.234,56" para um float ou "1.234" para um int).
          * **`get{CampoNumerico}()`:** Retorna o valor `int` ou `float` bruto para cálculos no PHP.

  * **Datas e Horas:**

      * **DB Tipo:** `DATETIME` ou `TIMESTAMP` para datas e horas completas. `DATE` para apenas a data.
      * **Formato Padrão:** O banco de dados deve armazenar no formato **internacional (`YYYY-MM-DD HH:MM:SS` ou `YYYY-MM-DD`)**.
      * **Tratamento PHP (via Entity Setters/Getters):**
          * **`set{CampoData}(string $data)`:** Converte string BR (`dd/mm/yyyy`) para objeto `Time` para salvar.
          * **`get{CampoData}FormatadaBr()`:** Retorna `string` formatada em BR (`dd/mm/yyyy`).

  * **Textos:**

      * **DB Tipo:** `VARCHAR(n)` para textos curtos e com limite de caracteres definido. `TEXT` para textos longos sem limite fixo.

  * **Valores Booleanos:**

      * **DB Tipo:** Use `INTEGER` ou `TINYINT(1)` para representar `true`/`false` (0 para falso, 1 para verdadeiro).
      * **Tratamento PHP:** O `$casts` do CodeIgniter já converte automaticamente para `boolean`.

-----

### 3\. Campos de Controle (TimeStamps)

O CodeIgniter tem um excelente suporte para gerenciar automaticamente as datas de criação, atualização e exclusão.

  * **`created_at`:** `DATETIME` ou `TIMESTAMP`. Preenchido automaticamente na criação do registro.
  * **`updated_at`:** `DATETIME` ou `TIMESTAMP`. Atualizado automaticamente a cada modificação do registro.
  * **`deleted_at`:** `DATETIME` ou `TIMESTAMP` (nullable). Usado para "Soft Deletes" (exclusão lógica).

-----

### 4\. Chaves Estrangeiras e Relacionamentos

  * Sempre use **chaves estrangeiras** para definir relacionamentos entre tabelas (ex: `usuario_id` na tabela `pedidos`).
  * Configure as **restrições de integridade referencial** (CASCADE, SET NULL, RESTRICT) conforme a lógica de negócio.

-----

### Exemplo de Estrutura de Tabela (`produtos`):

```sql
CREATE TABLE produtos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT,
    preco_unitario INTEGER NOT NULL,  -- Monetário: Armazenado em centavos
    peso_kg REAL,                     -- Numérico (não monetário): pode ser float
    quantidade_estoque INTEGER NOT NULL DEFAULT 0, -- Numérico (inteiro, não monetário)
    ativo INTEGER(1) NOT NULL DEFAULT 1,
    data_cadastro DATETIME NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    deleted_at DATETIME NULL
);
```
