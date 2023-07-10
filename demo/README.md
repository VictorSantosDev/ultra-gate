### PROJETO ULTRA GATE

---

### Start Project

´´´bash
### .env
mude o nome do arquivo .env.examp para .env

### instalando dependencias
docker exec setup-php composer install

### Criando tabelas do banco
docker exec setup-php php artisan migrate

### Gerando token JWT
docker exec setup-php php artisan jwt:secret
