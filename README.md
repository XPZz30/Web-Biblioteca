	# 📚 LivrariaWeb

	<p align="center">
	  <b>Sistema de Gerenciamento de Biblioteca Online</b>
	</p>

	---

	## ✨ Descrição

	LivrariaWeb é uma aplicação web robusta desenvolvida em Laravel, projetada para otimizar a gestão de bibliotecas. Permite cadastro, administração e controle de empréstimos de livros, categorias e usuários. A interface é moderna, responsiva e utiliza Bootstrap para garantir acessibilidade e usabilidade tanto para administradores quanto para usuários.

	---

	## 🚀 Funcionalidades

	### Dashboard Administrativa
	- Estatísticas rápidas: total de livros, categorias, usuários e empréstimos em tempo real
	- Acompanhamento dos últimos empréstimos, com status e opções de ações (aprovação, finalização)
	- CRUD completo para gestão de livros, categorias e usuários
	- Aprovação e finalização de empréstimos diretamente pelo painel

	### Gestão de Livros
	- Cadastro de livros com título, autor, ISBN, ano, estoque, descrição e capa
	- Edição e exclusão de livros
	- Controle de estoque com alertas

	### Gestão de Categorias
	- Criação, edição e exclusão de categorias
	- Associação de livros a categorias específicas

	### Gestão de Usuários
	- Cadastro e gerenciamento de usuários e administradores
	- Edição e exclusão de perfis
	- Controle de permissões por funções (admin/user)

	### Sistema de Empréstimos
	- Solicitação de empréstimos por usuários
	- Aprovação e finalização por administradores
	- Registro de data prevista e data de devolução
	- Status: pendente, aprovado, devolvido, atrasado
	- Histórico de empréstimos por usuário

	### Interface
	- Layout responsivo com Bootstrap
	- Estilização customizada (`custom.css`)
	- Feedback visual com ícones e alertas

	---

	## ⚙️ Requisitos

	- **PHP** >= 8.0
	- **Composer**
	- **Laravel** >= 10
	- **Banco de dados SQLite** (padrão, pode ser alterado para MySQL/PostgreSQL)

	---

	## 📂 Estrutura do Projeto

	```
	app/Http/Controllers   # Controladores das funcionalidades
	app/Models             # Modelos das principais entidades
	resources/views        # Views Blade (admin, livros, categorias, usuários, empréstimos)
	database/migrations    # Migrations das tabelas
	database/seeders       # Seeders para dados iniciais
	public/css             # Estilos customizados
	```

	---

	## 📜 Licença

	> Este projeto é de autoria exclusiva e não está disponível para uso sem a autorização expressa do criador. A reprodução, distribuição ou modificação do código está sujeita à permissão do autor.
