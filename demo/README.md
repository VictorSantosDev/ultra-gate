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

---

### Concluído

✅ Cadastro do usuário com validações de idade se é maior de 18 anos, e validação de CPF além dos demais campos que são validados.

✅ Cadastro de endereço do usuário com validação dos Campos e busca na Via Cep.

✅ Integração com a API Via Cep.

✅ Criando conta assim que usuário é cadastrado.

✅ Sistema de autenticação JWT.

### Pendente

❗Depósito iniciado mas não concluído.

❗Transferência não iniciado e não concluído.
