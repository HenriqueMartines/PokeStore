# ⚡ PokéStore - Sistema de Gestão e Vendas de Produtos Pokémon

---

## 1. Apresentação do Projeto

A **PokéStore** é uma aplicação web desenvolvida em PHP com integração ao banco de dados relacional PostgreSQL. O sistema foi concebido para atuar como uma loja virtual de cartas e itens colecionáveis do universo Pokémon, oferecendo uma vitrine para consulta de produtos por clientes e um painel administrativo para gerenciamento do catálogo.

A plataforma conta com páginas de apresentação, navegação de produtos, autenticação de usuários (clientes e administradores), além das operações fundamentais de **CRUD** (Criar, Ler, Atualizar e Deletar) para a gestão das cartas e estoque.

---

## 2. Como Executar o Projeto

Para executar a aplicação localmente ou em um servidor Linux de testes, é necessário ter instalado o servidor web Nginx, o PHP e o banco de dados PostgreSQL.

### 2.1 Pré-Requisitos

* **PHP** (v7.4 ou superior) habilitado com as extensões `pdo_pgsql` e `mbstring`.
* **PostgreSQL** em execução na porta padrão `5432`.
* **Nginx** instalado e configurado.
* **Git** para clonagem do repositório.

---

### 2.2 Passo 1: Clonar o Repositório

Abra o terminal e execute os comandos:

```bash
git clone https://github.com/HenriqueMartines/pokestore.git
cd pokestore
```

---

### 2.3 Passo 2: Configurar o Banco de Dados (PostgreSQL)

1. Conecte-se ao terminal do PostgreSQL com o usuário `postgres`:
   ```bash
   sudo -u postgres psql
   ```

2. Crie o banco de dados `pokemon_store`:
   ```sql
   CREATE DATABASE pokemon_store;
   \q
   ```

3. Importe a estrutura e os dados do arquivo `pokemon_store.sql` localizado na raiz do projeto:
   ```bash
   psql -U postgres -d pokemon_store -f pokemon_store.sql
   ```

---

### 2.4 Passo 3: Configurar Permissões de Pastas e Uploads (IMPORTANTE)

Para garantir que o servidor web consiga gravar as fotos dos produtos enviados pelo painel de administração na pasta `imagens/` sem erros de acesso negado:

```bash
# Define o usuário do Nginx (www-data) como proprietário do diretório
sudo chown -R www-data:www-data /var/www/html

# Concede permissões de leitura, escrita e execução
sudo chmod -R 775 /var/www/html
```

---

### 2.5 Passo 4: Configurar a Conexão no PHP

O arquivo de conexão encontra-se em `config/conexao.php`. Verifique se os dados do seu banco coincidem com o trecho configurado no código:

```php
<?php
$host     = "localhost"; // Ou o IP da máquina do servidor
$port     = "5432";
$database = "pokemon_store";
$usuario  = "pokestore";
$senha    = "pokestore";

define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/');

try {
    $conexao = new PDO("pgsql:host=$host;port=$port;dbname=$database", $usuario, $senha);
} catch (PDOException $e) {
    echo "Erro ao conectar com o banco de dados.";
}
?>
```

---
