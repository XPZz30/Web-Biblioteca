# LivrariaWeb

**Sistema de Gerenciamento de Biblioteca Online**

---

## Sobre o Projeto

LivrariaWeb é uma aplicação web desenvolvida em Laravel, criada para otimizar e facilitar a gestão de bibliotecas. O sistema permite o cadastro, administração e controle de empréstimos de livros, categorias e usuários, oferecendo uma interface moderna, responsiva e intuitiva baseada em Bootstrap.

### Tecnologias Utilizadas

- PHP 8+
- Laravel
- Bootstrap 5
- Blade (template engine)
- SQLite (padrão, adaptável para MySQL/PostgreSQL)
- Composer
- JavaScript (Vite, opcional)

### Principais Funcionalidades

- Dashboard administrativa com estatísticas em tempo real
- Listagem e acompanhamento dos últimos empréstimos
- CRUD completo para livros, categorias e usuários
- Aprovação e finalização de empréstimos pelo painel
- Cadastro de livros com título, autor, ISBN, ano, estoque, descrição e capa
- Controle de estoque com alertas
- Criação, edição e exclusão de categorias
- Associação de livros a categorias
- Cadastro, edição e exclusão de usuários e administradores
- Controle de permissões por função (admin/user)
- Solicitação, aprovação e finalização de empréstimos
- Registro de datas e status dos empréstimos (pendente, aprovado, devolvido, atrasado)
- Histórico de empréstimos por usuário
- Layout responsivo e customização visual

### Estrutura do Projeto

```
app/Http/Controllers   # Controladores das funcionalidades
app/Models             # Modelos das principais entidades
resources/views        # Views Blade (admin, livros, categorias, usuários, empréstimos)
database/migrations    # Migrations das tabelas
database/seeders       # Seeders para dados iniciais
public/css             # Estilos customizados
```

---

## Aviso Legal

Este projeto é de autoria exclusiva e não está disponível para uso, reprodução, distribuição ou modificação sem a autorização expressa do criador.
