# PortifolioG — WordPress em Docker

Ambiente local de desenvolvimento para o WordPress existente, com Apache, PHP 8.2, MySQL 8 e os plugins Elementor, Ultimate Addons for Elementor e WP Fastest Cache.

## Requisitos

- Docker Desktop com o plugin Docker Compose v2.
- Porta `8080` livre.
- Acesso à internet na primeira inicialização para baixar imagens e plugins que ainda não estejam instalados.

## Configuração e inicialização

O arquivo `.env` local já está preenchido para este projeto e não deve ser compartilhado. Se precisar recriá-lo, copie `.env.example` para `.env` e substitua as senhas de banco por valores fortes antes de iniciar. A senha inicial do administrador está definida no `.env` como solicitado; altere-a após o primeiro acesso, especialmente antes de expor o site a uma rede.

Na raiz do projeto:

```powershell
docker compose up -d
```

O serviço `wordpress-init` instala o WordPress quando necessário, define o título do site a partir de `WP_SITE_TITLE`, o idioma, o fuso horário e o administrador, e instala/ativa os três plugins. Na primeira execução, aguarde esse processo terminar:

```powershell
docker compose logs -f wordpress-init
```

O login do administrador é `gustavo-lima-barbosa`, com nome de exibição `GUSTAVO LIMA BARBOSA`. A senha inicial é a informada em `.env`.

- Site: <http://localhost:8080>
- Administração: <http://localhost:8080/wp-admin>

## Comandos úteis

```powershell
# Parar os serviços sem apagar dados
docker compose stop

# Reiniciar os serviços
docker compose restart

# Acompanhar todos os logs
docker compose logs -f

# Acompanhar o WordPress ou o banco
docker compose logs -f wordpress
docker compose logs -f db
```

Para encerrar e remover os containers e a rede, mantendo os dados persistentes:

```powershell
docker compose down
```

**Não** use `docker compose down -v` se quiser manter o banco de dados.

## Persistência e desenvolvimento

O diretório do projeto é montado em `/var/www/html`; alterações no núcleo, temas, plugins e uploads permanecem nos arquivos locais. O banco persiste no volume Docker `db_data`. O banco não publica nenhuma porta no host e só é acessível pela rede privada do Compose.

PHP está configurado com `memory_limit=512M`, limite de arquivo de 64 MB (e `post_max_size=80M`), tempo máximo de execução de 300 segundos e timezone `America/Fortaleza`. O WP Fastest Cache é instalado e ativado sem habilitar minificação, combinação ou outras otimizações agressivas; configure o cache de página no painel somente quando desejar testar esse comportamento.

O Apache também bloqueia acesso HTTP a `.env`, `.env.example` e `wp-config.php`, e desativa a listagem de diretórios.

## Backup

Crie uma cópia SQL do banco:

```powershell
docker compose exec -T db sh -c 'exec mysqldump -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE"' > backup-portifoliog.sql
```

O backup dos arquivos do site é feito copiando o diretório do projeto, incluindo `wp-content`, mas excluindo `.env`. Guarde o `.env` em local seguro e separado: ele contém credenciais necessárias para restauração.

## Restauração

1. Restaure os arquivos do projeto e coloque o `.env` salvo de volta na raiz.
2. Inicie os serviços e aguarde o banco ficar saudável:

   ```powershell
   docker compose up -d
   ```

3. Importe o SQL:

   ```powershell
   Get-Content .\backup-portifoliog.sql | docker compose exec -T db sh -c 'exec mysql -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE"'
   ```

4. Reinicie o processo de inicialização para conferir plugins e configurações:

   ```powershell
   docker compose run --rm wordpress-init
   ```

Se a restauração usar um endereço diferente, atualize as URLs do WordPress com WP-CLI antes de acessar o painel.
