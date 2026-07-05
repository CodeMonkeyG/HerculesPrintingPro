# Repository Memory

This file serves as a persistent memory and reference guide for the Hercules Printing Pro repository. It documents architectural decisions, system behaviors, unique solutions to technical hurdles, and development guidelines.

## Project Structure & Architecture

This is a decoupled **Monorepo** consisting of:
1. **Frontend (`/frontend`):** Vue 3 storefront developed with Vuetify 3 (Material Design), styled and managed modularly. Hosted in container `hercules-frontend`.
2. **Backend (`/backend`):** Bagisto 2.4.x (headless Laravel 12 e-commerce framework). Hosted in container `bagisto-backend`.
3. **Docker Configurations (`/docker` & `docker-compose.yml`):** Runs Nginx, Vue, Bagisto, Postgres, Redis, and Mailpit.

---

## Technical Hurdles & Solutions

### 1. Vue 3 reCAPTCHA Integration (`vue-recaptcha` v3 Checkbox)
- **Problem:** The typical `@verify` event on the `<Checkbox>` component did not consistently propagate the verification token within our reactive form binding setup.
- **Solution:** Switched to direct two-way binding using `v-model="form.captchaToken"` directly on the `<Checkbox>` component.
- **Reference File:** [frontend/src/views/ContactView.vue](frontend/src/views/ContactView.vue)

### 2. Core Mailer dynamic recipient routing
- **Problem:** By default, Bagisto's `ContactUs` mail template sent emails strictly to the Admin's address predefined in settings.
- **Solution:** Modified the `ContactUs` mail envelope resolver to dynamically load contact settings using `core()->getContactEmailDetails()`.
- **Reference File:** [backend/packages/Webkul/Shop/src/Mail/ContactUs.php](backend/packages/Webkul/Shop/src/Mail/ContactUs.php)

### 3. Container File Permissions & Docker Volumes
- **Problem:** Local volume mapping inside docker can cause Laravel storage and bootstrap cache directories to lose correct write permissions or get mapped with the incorrect host-level UID.
- **Solution:** Created an entrypoint script `docker/backend/entrypoint.sh` mounted inside the backend container to recursively bootstrap directory setup and enforce owner permissions (`www-data:www-data`) on startup.
- **Reference File:** [docker/backend/entrypoint.sh](docker/backend/entrypoint.sh)

---

## Common Development Workflows

To maintain host-machine neutrality, **always run commands inside their respective Docker containers** instead of installing dependencies locally:

### 1. Working with the Frontend (Node / Vue)
To install dependencies or run Vue scripts:
```bash
docker-compose exec vue-frontend npm install <package>
docker-compose exec vue-frontend <command>
```

### 2. Working with the Backend (Laravel / PHP / Artisan)
To interact with artisan, run tests, or manage packages:
```bash
docker-compose exec -u www-data bagisto-backend php artisan <command>
docker-compose exec -u www-data bagisto-backend composer require <package>
docker-compose exec -u www-data bagisto-backend vendor/bin/pest
```

### 3. dev Email Testing (Mailpit)
Mailpit runs as a container and parses all outgoing SMTP mail from Laravel.
- **SMTP Port (Internal):** `1025`
- **Web Dashboard Port (External):** `8025` (Visit `http://localhost:8025` in your browser)
