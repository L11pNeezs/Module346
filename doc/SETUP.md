# Set-up Koa-La project 

## Requirements
- Docker 

## Install Docker 
Install docker [Install Docker Engine on Fedora](https://docs.docker.com/engine/install/)

*don’t forget the Post-installation steps for linux for the permission issue* 


## Configure environment
create the .env file from .env.example : 

```bash
cp .env.example .env 
```

edit the .env file (using docker-compose.yml file) :

```bash
DB_CONNECTION=psql
DB_HOST=db #docker compose service name 
DB_PORT=5432 # check docker-compose.yml file
DB_DATABASE=<value>  # check docker-compose.yml file
DB_USERNAME=<value> # check docker-compose.yml file
DB_PASSWORD=<value> # check docker-compose.yml file
```
## Start Docker services 

- App service
- DB Service 

```bash
  $ docker compose up -d  
```

## Init DB

There’s two ways to run the migration of the database

- 1st Way (*directly from the root of the container*) :
```bash
  $ docker compose exec app bash (entering the container)
  $ php craft migrate
```

To exist the root container
```bash
  $ exit  
```
- 2nd Way (*directly from your engine*) :
```bash
  $ docker compose exec app php craft migrate -d
```

## Seed the DB / Restart the app
To seed the database with initial data, you can run the following command:
```bash
  $ docker compose down -v
  $ docker compose up -d
  $ docker build
  $ docker compose exec app php craft migrate -d
  $ docker compose exec app php craft seed
```

This will stop the containers, remove the volumes, rebuild the app container, and then run the migrations and seed the database with initial data.


### *Now we have the db and the app container running :D !!* 
