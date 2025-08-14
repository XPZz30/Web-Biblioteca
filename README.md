
# LivrariaWeb

Sistema de Gerenciamento de Biblioteca Online

## Descrição
LivrariaWeb é um sistema web desenvolvido em Laravel para gerenciar uma biblioteca, permitindo o cadastro, administração e empréstimo de livros, categorias e usuários. O projeto possui dashboard administrativa, controle de estoque, sistema de empréstimos com aprovação e devolução, além de interface moderna e responsiva utilizando Bootstrap.

## Funcionalidades

- **Dashboard Administrativa**
	- Visualização de estatísticas rápidas: total de livros, categorias, usuários e empréstimos
	- Listagem dos últimos empréstimos com status e ações
	- CRUD completo para livros, categorias e usuários
	- Aprovação e finalização de empréstimos diretamente pela dashboard

- **Livros**
	- Cadastro de novos livros com título, autor, ISBN, ano, estoque, descrição e capa
	- Edição e exclusão de livros
	- Controle de estoque

- **Categorias**
	- Cadastro, edição e exclusão de categorias
	- Associação de livros a categorias

- **Usuários**
	- Cadastro de usuários e administradores
	- Edição e exclusão de usuários
	- Controle de permissões por role (admin/user)

- **Empréstimos de Livros**
	- Solicitação de empréstimo por usuários
	- Aprovação e finalização de empréstimos por administradores
	- Registro de data prevista e data de devolução
	- Status do empréstimo: pendente, aprovado, devolvido, atrasado
	- Visualização dos empréstimos do usuário

- **Interface**
	- Layout responsivo com Bootstrap
	- Estilização customizada (custom.css)
	- Ícones e feedback visual para ações

## Requisitos
- PHP >= 8.0
- Composer
- Laravel >= 10
- Banco de dados SQLite (padrão, pode ser adaptado para MySQL/PostgreSQL)

## Instalação
1. Clone o repositório:
	 ```sh
	 git clone https://github.com/XPZz30/Web-Biblioteca.git
	 ```
2. Instale as dependências:
	 ```sh
	 composer install
	 ```
3. Configure o arquivo `.env` conforme seu ambiente
4. Execute as migrations:
	 ```sh
	 php artisan migrate
	 ```
5. (Opcional) Execute os seeders para dados iniciais:
	 ```sh
	 php artisan db:seed
	 ```
6. Inicie o servidor:
	 ```sh
	 php artisan serve
	 ```

## Estrutura do Projeto
- `app/Http/Controllers` - Controllers das funcionalidades
- `app/Models` - Models das entidades principais
- `resources/views` - Views Blade (admin, livros, categorias, usuários, empréstimos)
- `database/migrations` - Migrations das tabelas
- `database/seeders` - Seeders para dados iniciais
- `public/css` - Estilos customizados

## Licença
Dúvidas ou sugestões? Abra uma issue ou entre em contato!
Este projeto é autoral e não possui direito para livre uso. A reprodução, distribuição ou modificação não é permitida sem autorização expressa do autor.

---

Dúvidas ou sugestões? Abra uma issue ou entre em contato!
