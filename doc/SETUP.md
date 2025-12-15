# Set-up Koa-La Project

## Requirements
- Docker
- Composer
- PHP

## Install Docker
Install Docker following the official guide :  
https://docs.docker.com/engine/install/

## Install Composer

It's needed for the app to work, so in your terminal write :

```bash
composer install
```

# Start Docker Services

The project supports two environments: **development (editable)** and **production (fixed code)**.  

**Both apps can be started at the same time without any problem !**

## Development Environment (Editable Code)

Starts `app-dev` with a bind mount so code changes on your machine are reflected inside the container.

```bash
docker compose --profile dev up -d --build
```

This starts these services on the port **8080**:
- app-dev
- db
- mailhog

## Production Environment (Fixed Code - Not Editable)

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

#### Dev

```bash
docker compose exec app-dev bash
php craft migrate -d
exit
```

#### Prod

```bash
docker compose exec app-prod bash
php craft migrate -d
exit
```

### From your machine

#### Dev

```bash
docker compose exec app-dev php craft migrate -d
```

#### Prod

```bash
docker compose exec app-prod php craft migrate -d
```

## Seed the Database

### Dev

```bash
docker compose exec app-dev php craft migrate -d
docker compose exec app-dev php craft seed
```

### Prod

```bash
docker compose exec app-prod php craft migrate -d
docker compose exec app-prod php craft seed
```

This will:
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
docker compose --profile prod up -d --build
```

Edit the same file locally, refresh the browser: the change does not appear.

## File to Edit Suggestion

Go to public/index.php and right below "<?php", write:

```bash
echo "DEV TEST CHANGE"
```

- Once you do this, refresh the page and you will see that in the DEV Environment, the changes appear...
- On the other hand if you do this and then refresh the page in the PROD Environment, no changes will be done !

# COMMENTS (TO DELETE BEFORE SENDING)

installation php avec xampp/mamp/wamp (plus facile) (installer la version la plus récente pour éviter des soucis) (au lieu d'installer php pour le composer, lancer la commande, composer install --ignore-platform-req=ext-xml)

documenter la partie des logs


