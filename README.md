
---

# Cyber Nexus — Cyberpunk Management System

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-316192?style=for-the-badge&logo=postgresql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)

> **"High Tech, Low Life."**  
> Um ecossistema de gerenciamento web imersivo com temática Cyberpunk, focado no controle, consulta, atualização e remoção de dados essenciais da rede (CRUD).

---

##  Sobre o Projeto

O **Cyber Nexus** é uma aplicação web desenvolvida em **PHP (PDO)** e **PostgreSQL**. A proposta é gerenciar informações do universo Cyberpunk (como cibernéticos, missões e agentes) através de uma arquitetura modular, limpa e segura.

O projeto adota componentização para layouts compartilhados (`includes/header.php` e `includes/footer.php`) e centralização da camada de dados (`database/conexao.php`).

---

##  Status do Desenvolvimento

- [x] **Estrutura Base:** Layout responsivo, navegação com tratamento de rotas absolutas/relativas e inclusão modular (`header.php` e `footer.php`).
- [x] **Modelagem do Banco de Dados:** Schema SQL completo com PostgreSQL (`database.sql`).
- [x] **Conexão PHP + DB:** Camada de persistência segura utilizando **PDO** e **Prepared Statements**.
- [x] **Módulo de Implantes (100% Concluído):**
  - [x] Cadastro e Listagem (`app/implantes/index.php`)
  - [x] Inserção e Atualização com validação e tratamento de tipos (`salvar_implante.php`)
  - [x] Edição com passagem de ID oculto (`editar_implante.php`)
  - [x] Exclusão com confirmação visual (`excluir_implante.php`)
- [ ] **Próximos Módulos:**
  - [ ] Missões (Gerenciamento de contratos)
  - [ ] Agentes (Registro de fixers e mercenários)
  - [ ] Usuários (Autenticação e controle de acesso)
  - [ ] Estilização CSS Neon/Cyberpunk estendida

---

##  Estrutura do Projeto

```text
atividade final/
│
├── database/
│   ├── conexao.php          # Conexão PDO centralizada com o PostgreSQL
│   └── database.sql         # Script SQL para criação de tabelas e inserção de dados
│
├── includes/
│   ├── header.php           # Cabeçalho global e menu de navegação
│   └── footer.php           # Rodapé com informações e direitos
│
├── app/
│   └── implantes/           # Módulo completo de Implantes Cibernéticos
│       ├── index.php        # Listagem (Read) e formulário de adição (Create)
│       ├── salvar_implante.php  # Lógica de inserção e atualização no banco
│       ├── editar_implante.php  # Formulário de edição por ID (Update)
│       └── excluir_implante.php # Lógica de remoção de registro (Delete)
│
├── index.php                # Página inicial da aplicação
└── README.md                # Documentação do projeto

```

---

##  Modelagem de Dados

### Tabela `implantes`

| Campo | Tipo | Descrição |
| --- | --- | --- |
| `id` | `SERIAL PRIMARY KEY` | Identificador único incremental |
| `nome` | `VARCHAR(100)` | Nome do modelo do implante |
| `tipo` | `VARCHAR(50)` | Categoria (SISTEMA OCULAR, MEMBROS, etc.) |
| `preco` | `DECIMAL(10,2)` | Valor comercial em Edis (€$) |
| `descricao` | `TEXT` | Especificações e requisitos técnicos |
| `criado_em` | `TIMESTAMP` | Data/hora do registro |

---

##  Destaques Técnicos e Correções

* **Segurança:** Uso rigoroso de *Prepared Statements* com bind de parâmetros em todas as consultas SQL para mitigar **SQL Injection**.
* **Sanitização de Dados:** Aplicação de `htmlspecialchars()` na exibição de dados e `filter_input()` na captura do `POST`/`GET`.
* **Prevenção de Erros:**
* Tratamento de exceções com `PDOException`.
* Tratamento de navegabilidade usando o operador `../../` para navegação entre subpastas e raiz.
* Correção de verificação de coleções vazias com `!empty()` para garantir compatibilidade com versões recentes do PHP.



---

##  Como Executar o Projeto

1. **Configurar o Banco de Dados:**
* Abra seu gerenciador PostgreSQL (pgAdmin, DBeaver, etc.).
* Crie um banco chamado `cyber_nexus`.
* Execute o script contido em `database/database.sql`.


2. **Configurar a Conexão:**
* Abra o arquivo `database/conexao.php`.
* Ajuste as variáveis `$host`, `$port`, `$db`, `$user` e `$password` de acordo com suas credenciais locais.


3. **Iniciar o Servidor:**
* Execute o servidor web (Apache via XAMPP/WAMP ou servidor embutido do PHP):
```bash
php -S localhost:8000

```


* Acesse `http://localhost:8000` ou a pasta correspondente no servidor Apache.



```