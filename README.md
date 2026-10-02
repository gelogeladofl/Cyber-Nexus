
# Cyber Nexus — Cyberpunk Management System

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-316192?style=for-the-badge&logo=postgresql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)

> **"High Tech, Low Life."**  
> Um ecossistema de gerenciamento web imersivo com temática Cyberpunk, focado no controle, consulta, atualização e remoção de dados essenciais da rede (CRUD).

---

## Sobre o Projeto

O **Cyber Nexus** é uma aplicação web desenvolvida em **PHP (PDO)** e **PostgreSQL**. A proposta é gerenciar informações do universo Cyberpunk através de uma arquitetura modular, limpa e segura.

A aplicação divide-se em um portal central que dá acesso ao **Mural da Comunidade** (onde usuários cadastram e compartilham ideias/contratos) e ao **Arquivo Oficial de Missões do Jogo** (uma wiki com informações completas e sistema de comentários por missão).

---

## Status do Desenvolvimento

- [x] **Estrutura Base:** Layout responsivo, navegação com tratamento de rotas absolutas/relativas e inclusão modular (`header.php` e `footer.php`).
- [x] **Modelagem do Banco de Dados:** Schema SQL completo com PostgreSQL (`database.sql`), incluindo tabelas de implantes, missões da comunidade e comentários.
- [x] **Conexão PHP + DB:** Camada de persistência segura utilizando **PDO** e **Prepared Statements**.
- [x] **Portal Inicial (`index.php`):** Direcionamento para a área de ideias/contratos da comunidade e para a wiki do jogo.
- [x] **Módulo de Implantes (100% Concluído):**
  - [x] Cadastro e Listagem (`app/implantes/index.php`)
  - [x] Inserção e Atualização com validação e tratamento de tipos (`salvar_implante.php`)
  - [x] Edição com passagem de ID oculto (`editar_implante.php`)
  - [x] Exclusão com confirmação visual (`excluir_implante.php`)
- [x] **Módulo de Missões da Comunidade (CRUD completo):**
  - [x] Listagem e cadastro de ideias/contratos dos usuários (`app/missoes/index.php`)
  - [] Lógica de salvamento e edição (`salvar_missao.php`, `editar_missao.php`)
  - [] Exclusão de registros (`excluir_missao.php`)
- [x] **Módulo de Missões do Jogo (`app/missoes/jogo.php`):**
  - [x] Exibição de missões oficiais do Cyberpunk 2077 com detalhes de Fixers, distritos e briefings
  - [] Sistema de comentários dos usuários por missão (`salvar_comentario.php`)
- [ ] **Próximos Módulos:**
  - [ ] Agentes (Registro de fixers e mercenários)
  - [ ] Usuários (Autenticação, sessão e controle de acesso)
  - [ ] Estilização CSS Neon/Cyberpunk estendida

---

## Estrutura do Projeto

```text
atividade final/
│
├── database/
│   ├── conexao.php              # Conexão PDO centralizada com o PostgreSQL
│   └── database.sql             # Script SQL para criação de tabelas e inserção de dados
│
├── includes/
│   ├── header.php               # Cabeçalho global e menu de navegação
│   └── footer.php               # Rodapé com informações e direitos
│
├── app/
│   ├── implantes/               # Módulo completo de Implantes Cibernéticos
│   │   ├── index.php            # Listagem (Read) e formulário de adição (Create)
│   │   ├── salvar_implante.php  # Lógica de inserção e atualização no banco
│   │   ├── editar_implante.php  # Formulário de edição por ID (Update)
│   │   └── excluir_implante.php # Lógica de remoção de registro (Delete)
│   │
│   └── missoes/                 # Módulo de Missões
│       ├── index.php            # aqui e so o inicio que leva pra os dois outros menu de
        ├── mural.php            # Mural da comunidade / Ideias dos usuários (CRUD)
│       ├── salvar_missao.php    # Lógica de inserção/edição de missões
│       ├── editar_missao.php    # Edição de missões da comunidade
│       ├── excluir_missao.php   # Exclusão de missões da comunidade
│       ├── jogo.php             # Arquivo oficial de missões do Cyberpunk 2077
│       └── salvar_comentario.php# Lógica para salvar comentários nas missões do jogo
│
├── index.php                    # Portal inicial da aplicação
└── README.md                    # Documentação do projeto

```

---

## Modelagem de Dados

### Tabela `implantes`

| Campo | Tipo | Descrição |
| --- | --- | --- |
| `id` | `SERIAL PRIMARY KEY` | Identificador único incremental |
| `nome` | `VARCHAR(100)` | Nome do modelo do implante |
| `tipo` | `VARCHAR(50)` | Categoria (SISTEMA OCULAR, MEMBROS, etc.) |
| `preco` | `DECIMAL(10,2)` | Valor comercial em Edis (€$) |
| `descricao` | `TEXT` | Especificações e requisitos técnicos |
| `criado_em` | `TIMESTAMP` | Data/hora do registro |

### Tabela `missoes`

| Campo | Tipo | Descrição |
| --- | --- | --- |
| `id` | `SERIAL PRIMARY KEY` | Identificador único incremental |
| `nome` | `VARCHAR(100)` | Título do contrato ou ideia |
| `dificuldade` | `VARCHAR(20)` | Nível de risco (Baixa, Média, Alta, Extrema) |
| `recompensa` | `DECIMAL(10,2)` | Valor do pagamento (€$) |
| `status` | `VARCHAR(20)` | Estado atual (Pendente, Em Andamento, Concluída, Falhou) |
| `descricao` | `TEXT` | Briefing detalhado da operação |
| `criado_em` | `TIMESTAMP` | Data/hora do registro |

### Tabela `comentarios_missoes`

| Campo | Tipo | Descrição |
| --- | --- | --- |
| `id` | `SERIAL PRIMARY KEY` | Identificador único incremental |
| `missao_chave` | `VARCHAR(100)` | Identificador da missão do jogo associada |
| `autor` | `VARCHAR(100)` | Apelido do usuário que comentou |
| `comentario` | `TEXT` | Texto do comentário ou dica de estratégia |
| `criado_em` | `TIMESTAMP` | Data/hora do envio |

---

## Destaques Técnicos e Correções

* **Segurança:** Uso de *Prepared Statements* com bind de parâmetros em todas as consultas SQL para evitar **SQL Injection**.
* **Sanitização de Dados:** Aplicação de `htmlspecialchars()` na exibição e `filter_input()` na captura do `POST`/`GET`.
* **Navegabilidade:** Uso do operador `../../` para resolução de caminhos em subpastas sem quebrar a inclusão do `header.php` e `footer.php`.
* **Tratamento de Exceções:** Captura de erros de banco com `PDOException`.

---

## Como Executar o Projeto

1. **Configurar o Banco de Dados:**
* Abra seu gerenciador PostgreSQL (pgAdmin, DBeaver, etc.).
* Crie um banco de dados chamado `cyber_nexus`.
* Execute o script contido em `database/database.sql`.


2. **Configurar a Conexão:**
* Abra o arquivo `database/conexao.php`.
* Ajuste as variáveis `$host`, `$port`, `$db`, `$user` e `$password` conforme suas credenciais locais.


3. **Iniciar o Servidor:**
* Execute o servidor web (Apache ou o servidor embutido do PHP):
```bash
php -S localhost:8000

```


* Acesse `http://localhost:8000` no navegador.



```

```