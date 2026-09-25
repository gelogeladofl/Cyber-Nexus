# Cyberpunk System

## Sistema de gerenciamento Cyberpunk

Mini sistema web feito com **HTML + CSS + PHP + PostgreSQL**, com tema inspirado em Cyberpunk.

A ideia do projeto é criar um sistema simples de gerenciamento com algumas áreas diferentes, utilizando CRUD para cadastrar, consultar, atualizar e excluir informações.

---

## Pequeno Aviso

O projeto ainda está no começo.

Por enquanto estou fazendo primeiro a estrutura das páginas, como o `header.php`, `footer.php` e `index.php`.

Depois será feita a parte do banco de dados e os CRUDs.

Algumas funções ainda não estão prontas e serão adicionadas conforme o desenvolvimento do projeto.

---

## Funcionalidades
# Cyber Nexus — Cyberpunk Management System

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-316192?style=for-the-badge&logo=postgresql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)

> **"High Tech, Low Life."**  
> Um ecossistema de gerenciamento web feito por fã para fãs do universo Cyberpunk, focado no cadastro, consulta, atualização e exclusão de dados essenciais da rede.

---

##  Sobre o Projeto

O **Cyber Nexus** é um mini sistema web desenvolvido em PHP puro e PostgreSQL. A proposta é centralizar e gerenciar informações da *lore* do universo Cyberpunk através de operações completas de CRUD (Create, Read, Update, Delete).

O projeto adota uma arquitetura modular reaproveitável, centralizando cabeçalho e rodapé em componentes dedicados (`includes/header.php` e `includes/footer.php`).

---

##  Status do Desenvolvimento

>  **Projeto em desenvolvimento contínuo.**

- [x] **Estrutura Base:** Criação da página inicial (`index.php`) e modularização de layouts (`header.php` e `footer.php`).
- [x] **Design & Conteúdo:** Textos imersivos alinhados à temática *cyberpunk*.
- [ ] **Modelagem do Banco de Dados:** Criação do schema em PostgreSQL.
- [ ] **Conexão PHP + DB:** Implementação da camada de persistência.
- [ ] **Módulos CRUD:**
  - [ ] **Usuários** (Controle de acesso e contas)
  - [ ] **Implantes** (Catálogo de cibernéticos)
  - [ ] **Missões** (Gerenciamento de contratos)
  - [ ] **Agentes** *(Módulo opcional/expansão)*

---

##  Funcionalidades e Estrutura de Dados

### 1. Usuários
Módulo responsável pelo cadastro e gerenciamento das contas no sistema.
- `id` (PK)
- `nome`
- `email`
- `senha`

### 2. Implantes Cibernéticos
Catálogo completo de modificações corporais e próteses.
- `id` (PK)
- `nome`
- `descricao`
- `tipo`
- `preco`

### 3. Missões (Contratos)
Módulo para listagem e atribuição de contratos para mercenários e netrunners.
- `id` (PK)
- `nome`
- `descricao`
- `dificuldade`
- `recompensa`

### 4. Agentes *(Módulo Opcional)*
Espaço para documentação e registros confidenciais de agentes e corporações.

---

##  Tecnologias Utilizadas

- **Front-end:** HTML5, CSS3
- **Back-end:** PHP
- **Banco de Dados:** PostgreSQL

---

##  Estrutura de Pastas

```text
cyber-nexus/
│
├── includes/
│   ├── header.php   # Cabeçalho e navegação global
│   └── footer.php   # Rodapé com informações de contato e avisos
│
├─ app/
│  ├──
│  ├──
│  ├──
│  └──
│
├── index.php        # Página inicial
└── README.md        # Documentação do projeto
```