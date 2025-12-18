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

If it doesn't work because you're lacking php extensions, just write this instead :  

```bash
composer install --ignore-platform-req=ext-xml
```

# Chosen Characteristics

### 1 - Code Loading
 - Dev Env -> Source code can be modified
 - Prod Env -> Fixed source code

### 2 - Environment Variables (Logs)
 - Dev Env -> VERBOSE=true, DEBUG=true
 - Prod Env -> VERBOSE=false, DEBUG=false

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

## Both Environments At Once

In case you are lazy and only want to run one command once, do this instead :  

```bash
docker compose --profile all up -d --build
```

This starts `app-dev` and `app-prod` at the same time, together with all the other services:  
 - `db`:
    - `db-dev`
    - `db-prod`
 - `mailhog`

They are still in different containers !!

# Dev vs Prod Summary

| Mode | Service  | Editable | Logs |
|------|-----------|----------|-----|
| Dev  | app-dev   | Yes      | Yes |
| Prod | app-prod  | No       | No  |

# Verification

## Edit Verification

### Dev Mode

#### If you haven't ran this command yet do it, otherwhise just proceed to the next line :

```bash
docker compose --profile dev up -d --build
```

Edit a file locally. After doing so, refresh the browser by doing **CTRL + R** or pressing **f5**: the change appears.

### Prod Mode

#### If you haven't ran this command yet do it, otherwhise just proceed to the next line :

```bash
docker compose --profile prod up -d --build
```

Edit the same file locally, refresh the browser: the change does not appear.

### File to Edit Suggestion

#### Go to public/index.php, where a space specially reserved for test purposes is available and write :

```bash
echo "DEV TEST CHANGE"
```

## Logs Verification

#### Combined with the commands below, just randomly use the site features and sql logs will appear !!

### Dev Mode

```bash
docker compose logs -f app-dev
```

### Prod Mode

```bash
docker compose logs -f app-prod
```

# COMMENTS (DELETE BEFORE SENDING)

Avant d'enlever ça, s'assurer que toute la documentation est correcte et prête à envoyer !!!!!!!!
