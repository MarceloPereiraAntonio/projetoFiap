# 📘 Projeto Fiap - Sistema de Gestão Acadêmica

Este projeto é um sistema web desenvolvido em PHP puro com o objetivo de gerenciar alunos, turmas e matrículas, além de implementar autenticação via login e senha para administradores. Ele foi estruturado com base no padrão MVC e utiliza rotas protegidas por middleware.

---

## 🚀 Funcionalidades

- 🔐 Autenticação de administradores via e-mail e senha
- 🧑‍🎓 Cadastro, edição, listagem e exclusão de alunos
- 🏫 Cadastro, edição, listagem e exclusão de turmas
- ✅ Matrícula de alunos em turmas
- 🔎 Visualização de alunos por turma
- ✉️ Proteção de rotas (middleware `auth`)
- 📄 Validações simples no lado do servidor

---

## ⚙️ Instalação e uso

1. **Clone o projeto:**

```bash
git clone https://github.com/MarceloPereiraAntonio/projetoFiap.git
cd projetoFiap

```

2. **Instale as dependências do Composer:**

```bash
composer install

```

3. **Configure o .env :**
 - Faça a copia do arquivo .env.exemple

```bash
cp .env.exemple .env

```
- Ajuste as cofigurações 

```bash

DB_HOST=localhost
DB_NAME=Fiap
DB_USER=root
DB_PASS=

```

4. **Importe o banco de dados:**
- Use o arquivo dump.sql e importe ele para construção da base de dados do projeto, esse arquivo esta na raiz do projeto.

5. **Inicie o servidor embutido do PHP**
```bash
php -S localhost:8000 -t public

```

6. **Informações importante**
- No arquivo de importação do banco já se encontra alguns dados iniciais para uso e demonstração do projeto, e para o login no sistema use os seguintes dados:
- E-mail: admin@teste.com | Senha: admin123!

7. **Acesse o projeto 😄️**
```bash
http://localhost:8000/login

```