# 📒 Agenda de Contatos — Teste Prático PHP

Teste prático desenvolvido para a vaga de estágio em desenvolvimento PHP na **CMTECH/MEXX**.

---

## 📋 Sobre o Projeto

Sistema web de gerenciamento de contatos e usuários desenvolvido em PHP puro com arquitetura MVC, sem uso de frameworks externos. O projeto foi construído a partir de um CRUD de contatos já existente, que foi melhorado e expandido com novas funcionalidades.

---

## ✅ Funcionalidades

### Contatos
- Listar todos os contatos ativos
- Cadastrar novo contato
- Editar contato existente
- Excluir contato (exclusão lógica — o registro não é apagado do banco)
- Busca por nome em tempo real

### Usuários
- Listar todos os usuários ativos
- Cadastrar novo usuário
- Editar usuário existente
- Excluir usuário (exclusão lógica)
- Busca por nome
- Senha armazenada com hash bcrypt
- Validação de e-mail duplicado
- Confirmação de senha no cadastro

### Geral
- Flash messages — confirmação visual após cada ação
- Proteção contra SQL Injection com prepared statements PDO
- Proteção contra XSS com htmlspecialchars em todas as views
- Tratamento de exceções em todas as camadas

---

## 🏗️ Padrões de Projeto Utilizados

| Padrão | Onde |
|---|---|
| **Singleton** | `Conexao.php` — uma única conexão PDO por requisição |
| **Active Record** | `Contato.php`, `Usuario.php` — objetos que se persistem |
| **MVC** | Separação clara entre Model, View e Controller |
| **Front Controller** | `index.php` — ponto de entrada único da aplicação |
| **Template Method** | `Controller.php` — método `view()` herdado por todos os controllers |
| **Flash Message** | `Controller.php` — notificações via sessão PHP |

---

## 🗄️ Banco de Dados

### Tabela `contatos`
```sql
CREATE TABLE contatos (
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome       VARCHAR(80)  NOT NULL,
    telefone   VARCHAR(20)  DEFAULT NULL,
    email      VARCHAR(80)  DEFAULT NULL,
    ativo      TINYINT(1)   NOT NULL DEFAULT 1,
    deleted_at TIMESTAMP    NULL DEFAULT NULL
);
```

### Tabela `usuarios`
```sql
CREATE TABLE usuarios (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome          VARCHAR(100) NOT NULL,
    email         VARCHAR(100) NOT NULL UNIQUE,
    senha         VARCHAR(255) NOT NULL,
    ativo         TINYINT(1)   NOT NULL DEFAULT 1,
    deleted_at    TIMESTAMP    NULL DEFAULT NULL,
    criado_em     TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

---

## 🚀 Como Rodar o Projeto

### Requisitos
- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Laragon, XAMPP ou WAMP

### Passo a passo

**1. Clone o repositório:**
```bash
git clone https://github.com/pliniomartins/teste-php-estagio.git
```

**2. Coloque a pasta dentro do diretório do servidor:**
```
C:\laragon\www\agenda-contatos\
```

**3. Crie o banco de dados:**

Acesse o phpMyAdmin em `http://localhost/phpmyadmin`, crie um banco chamado `testephp` e execute o SQL do arquivo `bd.sql`.

**4. Configure a conexão:**

Abra o arquivo `Conexao.php` e ajuste as credenciais:
```php
new \PDO('mysql:host=localhost;port=3306;dbname=testephp', 'root', 'sua_senha');
```

**5. Acesse no navegador:**
```
http://agenda-contatos.test/
```

---

## 📁 Estrutura de Arquivos

```
agenda-contatos/
├── index.php                  — Front Controller (ponto de entrada)
├── Conexao.php                — Conexão PDO (Singleton)
├── Controller.php             — Controller base (flash, view, redirect)
├── Request.php                — Leitura de dados da requisição
├── Contato.php                — Model de Contatos
├── ContatosController.php     — Controller de Contatos
├── Usuario.php                — Model de Usuários
├── UsuariosController.php     — Controller de Usuários
├── form.php                   — View formulário de Contatos
├── grade.php                  — View listagem de Contatos
├── usuarios_form.php          — View formulário de Usuários
├── usuarios_grade.php         — View listagem de Usuários
├── bd.sql                     — Script SQL do banco de dados
└── respostas.txt              — Respostas às questões técnicas do exercício
```

---

## 🔒 Melhorias Implementadas no CRUD Original

| Problema Original | Solução Aplicada |
|---|---|
| SQL Injection com concatenação de strings | Prepared statements PDO com bind de parâmetros |
| `count()` usando `exec()` incorretamente | `query()` + `fetchColumn()` |
| XSS — dados exibidos sem sanitização | `htmlspecialchars()` em todas as views |
| Sem tratamento de erros | Try/catch em todas as camadas |
| Sem feedback ao usuário | Flash messages após cada ação |
| Exclusão física irreversível | Exclusão lógica com campo `deleted_at` |

---

## 🛠️ Tecnologias Utilizadas

- **PHP** — Backend
- **MySQL** — Banco de dados
- **HTML5 + CSS3** — Frontend
- **Bootstrap 4** — Estilização e componentes
- **JavaScript + jQuery** — Interatividade (accordion, alerts)
- **Font Awesome** — Ícones

---

## 👨‍💻 Autor

**Plinio Martins**  
Candidato à vaga de Estágio em Desenvolvimento PHP  
CMTECH / MEXX
