# Desafio Revvo

Projeto desenvolvido como parte do processo seletivo da Revvo.

## Desenvolvedor

Leonardo Barreiro  
Porto Alegre - RS  
Desenvolvedor Full-Stack

## Sobre o projeto

Este projeto implementa uma aplicação web simples para gerenciamento de cursos e exibição de conteúdos na página inicial.

O sistema possui um painel administrativo onde é possível gerenciar cursos e o conteúdo do slideshow da home.

A página inicial apresenta:

- Slideshow dinâmico
- Lista de cursos
- Modal exibido no primeiro acesso do usuário
- Layout responsivo

O desenvolvimento foi realizado utilizando **PHP puro**, conforme solicitado no desafio.

---

# Tecnologias utilizadas

- PHP (sem frameworks)
- MySQL
- HTML5
- CSS3
- JavaScript
- Font Awesome (para icones de rede social)
- Gulp (automatização de tarefas)
- SCSS

---

# Funcionalidades

## Front-end

- Layout responsivo
- Slideshow animado
- Cards de cursos
- Modal exibido no primeiro acesso
- Header com busca
- Footer com redes sociais

## Back-end

CRUD completo para:

### Cursos
- Criar curso
- Listar cursos
- Editar curso
- Excluir curso

### Slideshow
- Criar slide
- Listar slides
- Editar slide
- Excluir slide

Cada slide pode ser vinculado a um curso.

---

# Estrutura do projeto


desafio_revvo
│
├── admin
│ ├── cursos
│ └── slideshow
│
├── assets
│ ├── css
│ ├── js
│ ├── images
│ └── uploads
│
├── config
│ ├── config.php
│ └── database.php
│
├── includes
│ ├── header.php
│ ├── footer.php
│ └── modal.php
│
├── index.php
├── curso.php
├── login.php
├── cadastro.php
└── logout.php


---

# Instalação do projeto

1. Clonar o repositório


git clone https://github.com/seu_usuario/desafio_revvo


2. Criar o banco de dados MySQL

3. Importar o arquivo SQL (caso exista)

4. Configurar conexão no arquivo:


config/database.php


5. Rodar o projeto no servidor local (ex: XAMPP)


http://localhost/desafio_revvo

---
## Usuário administrador inicial

Para acessar o painel administrativo é necessário existir um usuário com perfil **admin** no banco de dados.

Caso o banco esteja vazio, execute o seguinte SQL para criar um usuário administrador inicial:

```sql
INSERT INTO usuarios (nome, email, senha, tipo)
VALUES (
  'Administrador',
  'admin@revvo.com',
  '$2y$10$KqV8G3F9Yz1b5e8H7FQ2uO1yHnL9Y9fQFJ5g8Y4YwTn0B8p3eG2bC',
  'admin'
);
```
usuario: Administrador

Senha: 123456

---

# Automatização de tarefas

O projeto utiliza **Gulp** para compilar arquivos SCSS e gerar CSS minificado.

Para instalar:


npm install


Para rodar:


gulp


---

# Observações

O projeto foi desenvolvido respeitando as orientações do desafio:

- PHP puro
- CRUD completo para cursos e slideshow
- Layout responsivo
- Modal exibido no primeiro acesso
- Uso de automatizador de tarefas
