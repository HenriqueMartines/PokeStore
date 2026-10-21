# Poke Store

## Deploy em uma VPS Linux

Configure o servidor web para apontar o document root para a pasta deste projeto.
O projeto requer PHP com as extensões `pdo_pgsql` e `fileinfo`, além de um
PostgreSQL acessível pelo servidor.

Por padrão, a aplicação tenta conectar ao PostgreSQL em `127.0.0.1:5432`,
ao banco `pokemon_store` e ao usuário `postgres`. Configure as credenciais
recomendadas em variáveis de ambiente do PHP, em vez de gravá-las no código:

| Variável | Padrão | Descrição |
| --- | --- | --- |
| `POKESTORE_DB_HOST` | `127.0.0.1` | Host do PostgreSQL |
| `POKESTORE_DB_PORT` | `5432` | Porta do PostgreSQL |
| `POKESTORE_DB_NAME` | `pokemon_store` | Nome do banco |
| `POKESTORE_DB_USER` | `postgres` | Usuário do banco |
| `POKESTORE_DB_PASSWORD` | vazio | Senha do banco |
| `POKESTORE_BASE_PATH` | vazio | Caminho da aplicação se não estiver na raiz do domínio, por exemplo `pokestore` |

No PHP-FPM, defina as variáveis no pool utilizado pelo site e reinicie o
serviço PHP-FPM e o servidor web. Por exemplo, no arquivo do pool:

```ini
env[POKESTORE_DB_HOST] = 127.0.0.1
env[POKESTORE_DB_PORT] = 5432
env[POKESTORE_DB_NAME] = pokemon_store
env[POKESTORE_DB_USER] = pokestore
env[POKESTORE_DB_PASSWORD] = substitua-por-uma-senha-forte
```

Use um usuário PostgreSQL próprio para a aplicação, com acesso apenas ao banco
utilizado pela loja. Não reutilize a conta administrativa `postgres` em
produção. Se o site estiver publicado em `https://exemplo.com/pokestore` em vez
da raiz, defina `POKESTORE_BASE_PATH` como `pokestore`.

Confira a conexão e as extensões no servidor:

```bash
php -m | grep -E 'PDO|pdo_pgsql|pgsql|fileinfo'
sudo systemctl status postgresql --no-pager
sudo -u postgres psql -d pokemon_store -c 'SELECT 1;'
```

O banco precisa conter as tabelas `produtos` (colunas `id`, `nome`, `preco`,
`imagem`, `descricao` e `quantidade`) e `usuarios` (colunas `usuario`, `senha`
e `tipo`). A coluna `usuarios.senha` deve aceitar pelo menos 255 caracteres
para armazenar hashes de senha. Se a coluna atual for menor, ajuste-a no
PostgreSQL:

```sql
ALTER TABLE usuarios ALTER COLUMN senha TYPE VARCHAR(255);
```

Se houve publicação da senha que estava anteriormente no código, troque-a no
PostgreSQL e configure a nova senha somente no ambiente da VPS.
Em produção, mantenha `display_errors` desativado e `log_errors` ativado no PHP
para que detalhes internos de falhas não sejam exibidos aos visitantes.
