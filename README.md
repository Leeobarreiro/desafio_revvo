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

# Instalação do projeto

1. Clonar o repositório


git clone https://github.com/seu_usuario/desafio_revvo


2. Importe o arquivo:

database.sql

Isso criará as tabelas necessárias para o funcionamento do sistema:

- usuarios
- cursos
- slideshow

3. Configurar conexão no arquivo:


config/database.php


4. Rodar o projeto no servidor local (ex: XAMPP)


http://localhost/desafio_revvo

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
