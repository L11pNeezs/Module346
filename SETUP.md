# Set-up Koa-La Project

## Requirements
- Docker

## Install Docker
Install Docker following the official guide:  
https://docs.docker.com/engine/install/

## Configure Environment

Create the `.env` file:

```bash
cp .env.example .env
```

Edit the `.env` file:

```dotenv
DB_CONNECTION=psql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=<value>
DB_USERNAME=<value>
DB_PASSWORD=<value>
```

# Start Docker Services

The project supports two modes: **development (editable)** and **production (fixed code)**.  
**Both apps can be started at the same time without any problem !**

## Development Mode (Editable Code)

Starts `app-dev` with a bind mount so code changes on your machine are reflected inside the container.

```bash
docker compose --profile dev up -d --build
```

This starts these services on the port **8080**:
- app-dev
- db
- mailhog

## Production Mode (Fixed Code - Not Editable)

Starts `app-prod` without a bind mount so the code inside the container is fixed in the image.

```bash
docker compose --profile prod up -d --build
```

This starts these services on the port **8081**:
- app-prod
- db
- mailhog

# Database Initialization

## Run Migrations

### Inside the container

```bash
docker compose exec app-dev bash
php craft migrate
exit
```

### From your machine

```bash
docker compose exec app-dev php craft migrate -d
```

## Seed the Database (Dev Mode)

```bash
docker compose down -v
docker compose --profile dev up -d --build
docker compose exec app-dev php craft migrate -d
docker compose exec app-dev php craft seed
```

This will:
- Stop containers
- Remove volumes
- Rebuild the app
- Run migrations
- Seed initial data

# Dev vs Prod Summary

| Mode | Service  | Editable |
|------|-----------|----------|
| Dev  | app-dev   | Yes      |
| Prod | app-prod  | No       |

# Verification

## Dev Mode

```bash
docker compose --profile dev up -d --build
```

Edit a file locally. After doing so, refresh the browser by doing **CTRL + R** or pressing **f5**: the change appears.

## Prod Mode

```bash
docker compose down
docker compose --profile prod up -d --build
```

Edit the same file locally, refresh the browser: the change does not appear.

## File to Edit Sugestion

Go to public/index.php and right below "<?php", write:

```bash
echo "DEV TEST CHANGE"
```

- Once you do this, refresh the page and you will see that in the DEV Environment, the changes appear...
- On the other hand if you do this and then refresh the page in the PROD Environment, no changes will be done !
