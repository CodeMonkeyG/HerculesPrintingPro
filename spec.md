# Technical Specification: Hercules Printing Pro Web-to-Print E-Commerce Platform
## Version: 1.0

## 1. Project Overview
This document outlines the technical architecture and infrastructure specifications for a modern, scalable web-to-print e-commerce platform. The system is designed to handle custom business card orders, process user-uploaded print files (CMYK PDFs), and route them to a dropship printing partner. 

The architecture follows a headless approach, ensuring a high-performance customer experience while maintaining robust, scalable order management on the backend.

---

## 2. Technology Stack
* **Frontend (Storefront):** Vue.js
* **Backend (E-Commerce Engine):** Bagisto (Headless API / Laravel PHP)
* **Database:** PostgreSQL
* **Web Server / Reverse Proxy:** Nginx
* **Containerization & Orchestration:** Docker & Docker Compose
* **Caching & Queues (Recommended):** Redis

---

## 3. Architecture & Container Orchestration
The entire environment will be containerized using Docker, managed via Docker Compose for streamlined development and production deployments. Nginx will act as the orchestrator and reverse proxy, routing incoming traffic to the appropriate internal containers.

### 3.1 Docker Compose Services
The `docker-compose.yml` will define the following core services:

* **`nginx`**: The public-facing entry point. Handles SSL termination and routes requests.
    * `/` -> Routes to the `vue-frontend` container.
    * `/api` & `/admin` -> Routes to the `bagisto-backend` container.
* **`vue-frontend`**: Node container serving the Vue.js storefront.
* **`bagisto-backend`**: PHP-FPM container running the Bagisto Laravel application.
* **`postgres`**: The central PostgreSQL database storing products, users, and order data.
* **`redis`**: Handles Bagisto session management, application caching, and background job queues (highly recommended for processing large print files without tying up PHP workers).

### 3.2 Running Commands
All commands for artisan, node, npm, or anything similar should all take place within the containers so that the host machine does not need to install any dependencies that should be completely contained within the docker containers.

---

## 4. System Data Flow

### 4.1 Customer Purchasing Flow
1.  **Browsing:** Customer visits the storefront (Vue.js). Vue fetches product catalogs, pricing tiers, and configuration options (paper weight, finish) via REST/GraphQL from the Bagisto API.
2.  **Customization:** Customer selects their configuration and uploads their print-ready CMYK design file.
3.  **Checkout:** Order is finalized. The frontend securely transmits the payload and file reference to the Bagisto backend. 

### 4.2 Dropship Integration (Web-to-Print Middleware)
1.  **Order Registration:** Bagisto registers the transaction in PostgreSQL and moves the order to a "Processing" state.
2.  **Event Trigger:** An event listener in Bagisto queues a background job (managed by Redis).
3.  **Payload Generation:** The job builds a JSON payload containing the dropshipper's required parameters (shipping address, SKU matching the selected configuration, and the secure URL to the uploaded PDF).
4.  **API Dispatch:** The payload is POSTed to the dropshipper's API endpoint.
5.  **Status Sync:** Webhooks from the dropshipper update the order status in Bagisto (e.g., "In Production", "Shipped") which is then visible to the user on the Vue frontend.

---

## 5. Development Milestones
1.  **Phase 1: Infrastructure Setup** * Initialize Git repository.
    * Draft `docker-compose.yml` and `Dockerfile` configurations for Vue, Bagisto, Postgres, and Nginx.
    * Configure Nginx routing logic.
2.  **Phase 2: Backend Foundations**
    * Install and configure Bagisto within the Docker environment.
    * Connect Bagisto to PostgreSQL.
    * Set up basic product catalog and pricing rules.
3.  **Phase 3: Frontend Development**
    * Initialize Vue application.
    * Build product selection UI and file upload component.
    * Integrate Bagisto API for cart and checkout flow.
4.  **Phase 4: Middleware & Dropship Integration**
    * Develop the custom Laravel module/script in Bagisto to handle API communication with the dropship partner.

---
*End of Document. To be expanded as specific dropshipper API details and design assets are finalized.*

