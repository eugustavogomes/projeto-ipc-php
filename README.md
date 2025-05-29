Projeto IPC com PHP e Daemon

Este projeto demonstra o uso de **comunicação entre processos (IPC)** em PHP utilizando **fila de mensagens (System V Message Queue)** para comunicação entre uma **interface web** e um **daemon rodando em background**. Os dados enviados via formulário são gravados em um banco **PostgreSQL**, e o resultado da operação é retornado ao usuário.

---
Tecnologias utilizadas

- PHP (CLI e servidor embutido)
- PostgreSQL
- System V IPC (`msg_send`, `msg_receive`)
- HTML + CSS (formulário estilizado)

---
 Requisitos

- PHP 8+ com a extensão `sysvmsg` habilitada
- PostgreSQL instalado e em execução
- macOS ou Linux (compatível com System V IPC)

---

 Como executar o projeto

### 1. Clone o repositório:

```bash
git clone https://github.com/seu-usuario/ipc-php-daemon.git
cd ipc-php-daemon

estilizar backgrounds pra ficar mais bonito
estrutura melhor as pastas 
confirmar que todos os requisitos foram cumpridos e que não há nenhum indício de feito com ia
adicionar na vercel


Crie um banco de dados
```
CREATE DATABASE ipc_project;
\c ipc_project
CREATE TABLE dados (
    id SERIAL PRIMARY KEY,
    valor TEXT NOT NULL
);```
```

Crie o arquivo de chave IPC
touch ipc_keyfile

Crie um .env (Opcional)
export DB_USER=postgres
export DB_PASS=sua_senha


Rode o DAEMON
php -S localhost:8000

Em outro terminal rode inicie o Servidor
php -S localhost:8000

Acesse o navegador em:
```
http://localhost:8000
```

## Como funciona

1. Usuário envia um valor pelo formulário
    
2. O script `form.php` envia esse valor via fila de mensagens IPC
    
3. O `daemon.php` recebe, insere no banco de dados e envia uma resposta
    
4. A resposta é exibida ao usuário
