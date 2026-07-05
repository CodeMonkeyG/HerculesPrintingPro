# CLAUDE.md (Root Guidelines)

This file provides system-wide guidelines to Claude Code (claude.ai/code) when working within the Hercules Printing Pro monorepo.

## Project Overview

A decoupled Monorepo featuring a **Vue 3/Vuetify 3** frontend (`/frontend`) and a **Bagisto (Laravel 12 / PHP 8.3)** headless backend (`/backend`). Database is **PostgreSQL**, caching and session management are handled via **Redis**, and mail delivery during development is routed to **Mailpit**.

For Laravel-specific, package-level details, refer to [backend/CLAUDE.md](backend/CLAUDE.md).

---

## Technical Specifications

- **Containerization Rules:** All CLI commands (npm, artisan, composer) should run inside their docker containers via `docker-compose exec` to preserve absolute host machine neutrality.
- **Frontend Core Stack:** Vue 3, Vue-Recaptcha (Checkbox), Vuetify 3, Vite.
- **Backend Core Stack:** Laravel 12 (latest), Bagisto 2.4.x, Pest 3 (testing), Pint (code style).

---

## Common Development Commands

### 1. Docker Orchestration
```bash
docker-compose up -d             # Start all services with hot-reloading
docker-compose down              # Stop and tear down all container resources
docker-compose logs -f           # Follow container output logs
```

### 2. Frontend Development & Build Scripts
All commands should target the `vue-frontend` service container:
```bash
docker-compose exec vue-frontend npm install           # Sync package dependencies
docker-compose exec vue-frontend npm run build          # Build static assets for production
```

### 3. Backend (Laravel / Artisan) Operations
All commands should target the `bagisto-backend` service container:
```bash
docker-compose exec -u www-data bagisto-backend composer install         # Sync PHP packages
docker-compose exec -u www-data bagisto-backend php artisan optimize:clear # Clear config/routing cache
docker-compose exec -u www-data bagisto-backend vendor/bin/pest          # Run PHP test suite
docker-compose exec -u www-data bagisto-backend vendor/bin/pint          # Enforce Pint code standards
```

---

## Architectural Rules

1. **Frontend-Backend API Communication:**
   Frontend routes contact submissions directly to the backend endpoint `${VITE_BACKEND_URL}/api/contact`.
2. **Modular Architecture:**
   All backend logic belongs inside `backend/packages/Webkul/` following the Repository and Proxy architectural patterns. Do not write core business logic in backend-level app models directly.
3. **Email Routing:**
   Mailpit captures all mail sent during dev sessions. Standard contact details are resolved dynamically rather than static variables.
