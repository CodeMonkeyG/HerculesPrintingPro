# Hercules Printing Pro

**Hercules Printing Pro** is a modern, scalable web-to-print e-commerce platform designed to process custom print orders (such as business cards and promotional materials) with automated CMYK print-ready file validation and dropship fulfillment integration.

---

## 🏗 Architecture & Stack

The platform is built as a decoupled, headless application fully orchestrated with Docker Compose:

* **Frontend (Storefront):** Vue.js 3, Vite, Vuetify 3 (Material Design).
* **Backend (E-Commerce Engine):** Headless API built on the Bagisto e-commerce platform & Laravel 12.
* **Database:** PostgreSQL 15.
* **Cache & Queues:** Redis (handles application caching, session management, and background print processing queues).
* **Local Email Testing:** Mailpit (intercepts all outgoing system mail).
* **Container Orchestration:** NGINX reverse proxy container routing internal microservices.

---

## 🐳 Docker Services & Network Topology

The project runs completely inside Docker containers to maintain environment isolation:

| Container Name | Service | Internal Port | Host Mapped Port | Description |
| :--- | :--- | :--- | :--- | :--- |
| `hercules-nginx` | NGINX Reverse Proxy | `80`, `443` | `8081`, `8441` | Public entry point; routes `/api` & `/admin` to backend, `/` to frontend |
| `hercules-frontend` | Vue 3 / Vite | `5173` | Internal | Storefront web application |
| `hercules-backend` | Bagisto / PHP-FPM | `9000` | Internal | Headless E-Commerce REST API |
| `hercules-postgres` | PostgreSQL 15 | `5432` | Internal | Database storage |
| `hercules-redis` | Redis | `6379` | Internal | Queue worker & cache store |
| `hercules-mailpit` | Mailpit | `1025`, `8025` | `1025`, `8025` | Mail testing dashboard accessible at `http://localhost:8025` |

---

## 🚀 Quick Start

### 1. Launch the Stack
```bash
docker compose up -d
```

### 2. Access the Application
* **Storefront:** `https://localhost:8441` or `http://localhost:8081`
* **Mailpit Dashboard:** `http://localhost:8025`

### 3. Dependency Management & Execution (Host Isolation)
Do not run `node`, `npm`, `composer`, or `php` commands directly on your host machine. Proxy execution through active Docker containers:

```bash
# Frontend dependencies
docker compose exec vue-frontend npm install <package_name>

# Backend dependencies
docker compose exec -u www-data bagisto-backend composer require <package_name>

# Run Pest test suites
docker compose exec -u www-data bagisto-backend vendor/bin/pest

# Code styling (Laravel Pint)
docker compose exec -u www-data bagisto-backend vendor/bin/pint
```

---

## 🌐 Bare Metal NGINX Reverse Proxy

To run **Hercules Printing Pro** alongside other containerized applications (such as Pintventory) on the same host machine, the containerized NGINX host ports have been shifted to `8081` (HTTP) and `8441` (HTTPS). 

The host bare-metal NGINX reverse-proxies incoming domain traffic:
* `http://herculesprintingpro.com` -> `http://127.0.0.1:8081`
* `https://herculesprintingpro.com` -> `https://127.0.0.1:8441`
