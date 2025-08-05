
# 🎓 Desafio Revvo - Sistema de Cursos e Slides

<p align="center">
  <img src="https://img.shields.io/badge/PHP-Puro-blue" alt="PHP Puro">
  <img src="https://img.shields.io/badge/HTML5-CSS3-yellow" alt="HTML5 CSS3">
  <img src="https://img.shields.io/badge/SASS-Compilado-red" alt="SASS">
  <img src="https://img.shields.io/badge/Status-Concluído-brightgreen" alt="Status">
</p>

Sistema criado como desafio técnico proposto pela Revvo. O objetivo é desenvolver uma aplicação em PHP puro com interface moderna, responsiva e com funcionalidades básicas de cadastro e listagem de cursos e slides.

---

## ⚙️ Funcionalidades

- ✅ CRUD completo de **Cursos**
- ✅ CRUD completo de **Slides (Carrossel)**
- ✅ Modal de boas-vindas no **primeiro acesso**
- ✅ Layout 100% responsivo (mobile, tablet e desktop)
- ✅ Avatar e menu suspenso simulando usuário logado
- ✅ Upload de imagem para cursos e slides
- ✅ Estilização com **SASS**
- ✅ Código versionado com commits frequentes
- ✅ Sem frameworks (PHP puro)

---

## 🛠 Tecnologias Utilizadas

- **PHP Puro**
- **MySQL**
- **HTML5 & CSS3**
- **SASS (compilado via Gulp)**
- **JavaScript (vanilla)**
- **Git e GitHub**

---

## 📁 Estrutura do Projeto

```plaintext
/desafio_revvo
├── css/
│   └── style.css           # Compilado a partir do style.scss
├── img/
│   └── Foto.jpg            # Imagem do avatar
├── includes/
│   ├── db.php              # Conexão com banco de dados
│   ├── header.php          # Cabeçalho com avatar
│   ├── footer.php          # Rodapé
│   ├── layout_start.php
│   └── layout_end.php
├── js/
│   ├── modal.js            # Lógica do modal de boas-vindas
│   └── carousel.js         # Script do carrossel de slides
├── pages/
│   ├── form_curso.php
│   ├── list_cursos.php
│   ├── form_slide.php
│   └── list_slides.php
├── uploads/
│   └── ...                 # Imagens salvas do upload
├── style.scss              # Arquivo SASS original
├── index.php
└── README.md
```

---

## 🧰 Passo a Passo para Execução

### 1. Requisitos

- PHP 8+
- MySQL
- Apache (XAMPP ou similar)
- Gulp (para compilar SASS)
- Navegador atualizado

---

### 2. Banco de Dados

Crie o banco de dados com as seguintes tabelas:

```sql
CREATE DATABASE desafio_revvo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE desafio_revvo;

CREATE TABLE cursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT NOT NULL,
    imagem VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE slides (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT,
    imagem VARCHAR(255),
    link VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

### 3. Rodando o Projeto

1. Clone o projeto:
```bash
git clone https://github.com/seu_usuario/desafio_revvo.git
cd desafio_revvo
```

2. Mova a pasta `desafio_revvo` para dentro da pasta `htdocs` (XAMPP):
```
C:\xampp\htdocs\desafio_revvo
```

3. Crie o banco de dados e execute os scripts SQL acima no phpMyAdmin.

4. Ajuste o arquivo `includes/db.php` com as credenciais corretas do seu MySQL:

```php
$pdo = new PDO('mysql:host=localhost;dbname=desafio_revvo;charset=utf8', 'root', '');
```

5. Inicie o servidor Apache pelo XAMPP e acesse:

```
http://localhost/desafio_revvo/
```

---

## 📱 Responsividade

O layout foi feito com **grid flexível**, **media queries** e **componentes adaptativos** para diferentes tamanhos de tela. Foi testado em:

- 📱 Mobile
- 💻 Notebook
- 🖥️ Desktop

---

## 🔐 Modal no Primeiro Acesso

O modal de boas-vindas é controlado por `localStorage`. Ele aparece apenas uma vez por navegador e só na primeira visita à `index.php`.

---

## 🧼 Observações Finais

- Todos os dados são salvos no banco de dados local (`MySQL`).
- O projeto respeita o uso exclusivo de **PHP puro**, sem frameworks.
- Todos os estilos foram escritos em **SASS** e compilados para CSS.


---

## 📅 Data de entrega

🗓️ Entregue em: **05/08/2025**
