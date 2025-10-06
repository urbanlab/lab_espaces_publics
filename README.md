# Wordpress
This wordpress stack uses bedrock for easy wordpress development.

## Requirements
- You need to have docker installed on your machine.
- Copy .env.example to .env and fill in the required variables.

## Getting started

### Dev

Install the stack (first start only):
```
bin/dev/install
```

Next time you only have to start the stack using the following command:
```
bin/dev/start
```

By default the stack will start with the following services:
- wordpress : http://localhost:8080
- phpmyadmin : http://localhost:8081
- mysql
- node

### Production

Start the stack:
`docker-compose up --profile prod -d`

## Notes

**Create a bedrock project**
`docker run --rm -v $(pwd):/app -u $(id -u):$(id -g) composer create-project roots/bedrock`

`docker run --rm -v $(pwd):/app -u $(id -u):$(id -g) lab_espaces_publics-apache-dev-1 wp acorn vendor:publish`
