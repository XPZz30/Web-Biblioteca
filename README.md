
# LivrariaWeb

Sistema de Gerenciamento de Biblioteca Online

## Descrição
LivrariaWeb é um sistema web desenvolvido em Laravel para gerenciar uma biblioteca, permitindo o cadastro, administração e empréstimo de livros, categorias e usuários. O projeto possui dashboard administrativa, controle de estoque, sistema de empréstimos com aprovação e devolução, além de interface moderna e responsiva utilizando Bootstrap.


# LivrariaWeb

**Sistema de Gerenciamento de Biblioteca Online**

---

## Descrição
LivrariaWeb é uma aplicação web desenvolvida em Laravel para otimizar a gestão de bibliotecas. Permite cadastro, administração e controle de empréstimos de livros, categorias e usuários, com interface moderna e responsiva baseada em Bootstrap.

---

## Funcionalidades

- **Dashboard Administrativa**: Estatísticas em tempo real, últimos empréstimos, ações rápidas (aprovação/finalização), CRUD completo de livros, categorias e usuários.
- **Gestão de Livros**: Cadastro com título, autor, ISBN, ano, estoque, descrição e capa; edição e exclusão; controle de estoque com alertas.
- **Gestão de Categorias**: Criação, edição, exclusão e associação de livros.
- **Gestão de Usuários**: Cadastro, edição, exclusão, permissões por função (admin/user).
- **Sistema de Empréstimos**: Solicitação, aprovação, finalização, registro de datas, status (pendente, aprovado, devolvido, atrasado), histórico por usuário.
- **Interface**: Layout responsivo, customização visual (`custom.css`), feedback visual com ícones e alertas.

---

## Requisitos

- PHP >= 8.0
- Composer
- Laravel >= 10
- Banco de dados SQLite (padrão, pode ser alterado para MySQL/PostgreSQL)

---

## Estrutura do Projeto

```
app/Http/Controllers   # Controladores das funcionalidades
app/Models             # Modelos das principais entidades
resources/views        # Views Blade (admin, livros, categorias, usuários, empréstimos)
database/migrations    # Migrations das tabelas
database/seeders       # Seeders para dados iniciais
public/css             # Estilos customizados
```

---

## Licença
Este projeto é de autoria exclusiva e não está disponível para uso sem a autorização expressa do criador. A reprodução, distribuição ou modificação do código está sujeita à permissão do autor.
	- **Composer**
