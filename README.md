
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

	LivrariaWeb

	Sistema de Gerenciamento de Biblioteca Online

	Descrição

	LivrariaWeb é uma aplicação web robusta desenvolvida em Laravel, projetada para otimizar a gestão de bibliotecas. Este sistema permite o cadastro, administração e controle de empréstimos de livros, categorias e usuários. A interface oferece uma experiência moderna e responsiva, utilizando o framework Bootstrap, garantindo funcionalidade e acessibilidade tanto para administradores quanto para usuários.

	Funcionalidades

	Dashboard Administrativa
	- Exibição de estatísticas rápidas: total de livros, categorias, usuários e empréstimos em tempo real
	- Acompanhamento dos últimos empréstimos, com status e opções de ações (aprovação, finalização)
	- CRUD completo para gestão de livros, categorias e usuários
	- Aprovação e finalização de empréstimos diretamente através do painel de controle

	Gestão de Livros
	- Cadastro de livros com detalhes como título, autor, ISBN, ano de publicação, quantidade disponível em estoque, descrição e capa
	- Opções de edição e exclusão de registros de livros
	- Controle completo de estoque, com alertas para livros próximos da baixa no inventário

	Gestão de Categorias
	- Criação, edição e exclusão de categorias
	- Associação de livros a categorias específicas para facilitar a organização

	Gestão de Usuários
	- Cadastro e gerenciamento de usuários e administradores
	- Edição e exclusão de perfis de usuários
	- Controle de permissões por funções (admin/user)

	Sistema de Empréstimos
	- Solicitação de empréstimos por usuários
	- Aprovação e finalização de empréstimos por administradores
	- Registro de data prevista e data de devolução dos livros
	- Status do empréstimo: pendente, aprovado, devolvido, atrasado
	- Acompanhamento de todos os empréstimos realizados por cada usuário

	Interface
	- Layout totalmente responsivo utilizando Bootstrap
	- Estilização customizada com arquivo custom.css para adaptação visual
	- Feedback visual em tempo real com ícones e mensagens de alerta

	Requisitos

	PHP >= 8.0
	Composer
	Laravel >= 10
	Banco de dados SQLite (configuração padrão, pode ser alterado para MySQL/PostgreSQL)

	Instalação

	Clone o repositório:

	git clone https://github.com/XPZz30/Web-Biblioteca.git

	Instale as dependências do Composer:

	composer install

	Configure o arquivo .env de acordo com seu ambiente

	Execute as migrations:

	php artisan migrate

	(Opcional) Para inserir dados iniciais, execute os seeders:

	php artisan db:seed

	Inicie o servidor de desenvolvimento:

	php artisan serve

	Estrutura do Projeto

	app/Http/Controllers - Controladores para as funcionalidades do sistema
	app/Models - Modelos das principais entidades (livros, categorias, usuários)
	resources/views - Views Blade para o painel administrativo e páginas dos usuários
	database/migrations - Migrations para criação das tabelas no banco de dados
	database/seeders - Seeders para inserir dados iniciais
	public/css - Arquivos de estilos customizados

	Licença

	Este projeto é de autoria exclusiva e não está disponível para uso sem a autorização expressa do criador. A reprodução, distribuição ou modificação do código está sujeita à permissão do autor.
