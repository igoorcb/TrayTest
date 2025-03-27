
<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

---

## ⚙️ Tecnologias Utilizadas

**Backend (Laravel)**
- PHP 8.2
- Laravel 12
- MySQL 8
- Queue com `database` + `queue:work`
- Autenticação com Google OAuth 2.0
- Envio de e-mails (SMTP real, assíncrono)
- Testes com PHPUnit
- Arquitetura Service/Repository
- Docker

**Frontend (Vue)**
- Vue 3 + TypeScript
- Vue Router + Pinia
- Sass (SCSS)
- Integração com API Laravel
- UX/UI com feedbacks e responsividade
- Vitest (testes unitários configurado)
- Docker

---

## 🚀 Como rodar o projeto

### 🔁 1. Clonar o repositório
```bash
git clone https://github.com/seu-usuario/TrayTest.git
cd TrayTest
```

### 🐳 2. Subir os containers com Docker
```bash
docker compose up -d --build
```

A API estará disponível em `http://localhost:8000`  
O Front-end em `http://localhost:5173`

---

### ⚙️ 3. Instalar dependências e configurar Laravel

Entre no container do backend:
```bash
docker exec -it tray_backend bash
```

Rode os comandos:
```bash
composer install
php artisan key:generate

Abrir fila de email:  docker exec -it tray_backend php artisan queue:work ( sem isso o email nao é enviado ) 
```

---

## 🔐 Login com Google

Acesse:
```
GET http://localhost:8000/api/auth/google/redirect
```

- Será gerada a URL de autenticação do Google
- Ao concluir o login, você será redirecionado com o e-mail
- O e-mail será salvo no banco, e será exibida a tela para completar o perfil

---

## 📋 Cadastro Completo

Acesse a rota `/complete-profile?email=usuario@email.com` no front-end.

Preencha:
- Nome
- CPF
- Data de nascimento

Após isso, o usuário será salvo e receberá um e-mail de confirmação.

---

## 👥 Listagem de Usuários

Acesse:
```
http://localhost:5173/users
```

- Filtro por nome e CPF com debounce
- Paginação (10 por página)
- Botão para listar todos
- Botão para limpar buscas
- UI moderna e responsiva

---

## ✅ Testes

### Back-end
```bash
docker exec -it tray_backend php artisan test
```

Testes em:
- Service (`UserServiceTest`)
- Controller (`UserControllerTest`)

### Front-end
```bash
docker exec -it tray_frontend bash
npx vitest
```

Vitest está configurado com suporte para Vue + TS.

---

## 📦 Estrutura do Projeto

```
/TrayBackend (Laravel API)
  └── app/
      ├── Services/
      ├── Repositories/
      ├── Contracts/
      ├── Http/Controllers/
      ├── Mail/
      └── Resources/
  └── tests/
      ├── Feature/
      └── Unit/

/TrayFrontend (Vue)
  └── src/
      ├── views/
      ├── components/
      ├── store/
      └── router/
```

---

## 💡 Considerações

- Projeto estruturado com boas práticas (DDD, SOLID, Clean Code)
- Toda comunicação via API RESTful
- Integração com Google feita com lib oficial:
  [google-api-php-client](https://github.com/googleapis/google-api-php-client)
- Envio de e-mail assíncrono via fila e SMTP funcional
- Foco em experiência do usuário com carregamento, feedback e responsividade

---

