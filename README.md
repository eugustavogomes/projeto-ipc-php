````markdown
# Projeto IPC com PHP e Daemon

Este projeto demonstra o uso de **comunicação entre processos (IPC)** em PHP utilizando **fila de mensagens (System V Message Queue)** para comunicação entre uma **interface web** e um **daemon rodando em background**. Os dados enviados via formulário são gravados em um banco **PostgreSQL**, e o resultado da operação é retornado ao usuário.

---

## Tecnologias utilizadas

- PHP (CLI e servidor embutido)
- PostgreSQL
- System V IPC (`msg_send`, `msg_receive`)
- HTML + CSS (formulário estilizado)

---

## Requisitos

- PHP 8+ com a extensão `sysvmsg` habilitada
- PostgreSQL instalado e em execução
- macOS ou Linux (compatível com System V IPC)

---

## Como executar o projeto

### 1. Clone o repositório:

```bash
git clone https://github.com/seu-usuario/ipc-php-daemon.git
cd ipc-php-daemon
````

### 2. Crie o banco de dados:

```sql
CREATE DATABASE ipc_project;
\c ipc_project
CREATE TABLE dados (
    id SERIAL PRIMARY KEY,
    valor TEXT NOT NULL
);
```

### 3. Crie o arquivo de chave IPC:

```bash
touch ipc_keyfile
```

### 4. (Opcional) Crie o arquivo `.env` com as credenciais do banco:

```bash
export DB_USER=postgres
export DB_PASS=sua_senha
```

### 5. Rode o daemon:

```bash
source .env   # se estiver usando variáveis de ambiente
php daemon.php
```

### 6. Em outro terminal, inicie o servidor web:

```bash
php -S localhost:8000
```

### 7. Acesse o navegador:

```
http://localhost:8000
```

---

## Como funciona

1. O usuário envia um valor pelo formulário.
    
2. O `form.php` envia esse valor via fila de mensagens IPC.
    
3. O `daemon.php` recebe, insere o dado no banco de dados e envia uma resposta.
    
4. A resposta é exibida ao usuário no navegador.
    