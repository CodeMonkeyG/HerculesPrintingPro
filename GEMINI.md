# GEMINI.md (Workspace Guidelines)

This file provides system-wide guidelines to Gemini models (such as Gemini 3.5 Flash/Pro) and Gemini-based agents when working within this monorepo.

## Workspace Overview

The project is structured as a decoupled monorepo:
* **`/frontend`** — Storefront built on Vue 3, Vite, and Vuetify 3.
* **`/backend`** — Headless API engine built on Bagisto e-commerce platform & Laravel 12.
* **`/docker`** — Infrastructure orchestration, including Nginx configs, dev services (Postgres, Redis, and Mailpit), and custom service entrypoints.

---

## Technical Context & Constraints

When implementing features or refactoring modules:

1. **Host Isolation:**
   Do not run node, npm, composer, or php commands directly on the host machine. Instead, proxy execution through the active Docker containers to maintain environment integrity.

2. **Frontend reCAPTCHA Handling:**
   We utilize `vue-recaptcha` v3. Checkboxes are bound directly using `v-model` (for instance, `v-model="form.captchaToken"`), while errors/successes are managed reactively via status tracking blocks.

3. **Backend API Route Registration:**
   The backend API endpoints (such as the contact handler `/contact`) are registered in [backend/routes/api.php](backend/routes/api.php), and are mapped in the application configuration inside [backend/bootstrap/app.php](backend/bootstrap/app.php).

4. **Modular Code standards:**
   Avoid creating models or direct database interactions under standard Laravel `app/Models/` namespace. Ensure domain-specific behaviors reside in a corresponding custom module / package within the [backend/packages/Webkul/](backend/packages/Webkul/) space, employing designated proxies and repositories.

---

## Reference Commands for Gemini

### Running the Project:
```bash
docker-compose up -d               # Launch full stack
```

### Dependency Management (Node/Composer):
```bash
docker-compose exec vue-frontend npm install <package_name>
docker-compose exec -u www-data bagisto-backend composer require <package_name>
```

### Static Analysis, Linting & Testing:
```bash
docker-compose exec -u www-data bagisto-backend vendor/bin/pest         # Run Laravel Test Suites
docker-compose exec -u www-data bagisto-backend vendor/bin/pint         # Run Laravel Pint Code Stylizer
```

### Mailpit Interface:
For developer sanity, verify sent emails by visiting `http://localhost:8025/` in your browser. All system outgoing mail will be intercepted locally.
