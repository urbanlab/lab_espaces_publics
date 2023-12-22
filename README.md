# Wordpress
This wordpress stack uses bedrock for easy wordpress development.


## Getting started

First you need to install the dependencies. This is done by running the following command:

**Update bedrock with composer"
```
cd bedrock
docker run --rm -v $(pwd):/app -u $(id -u):$(id -g) composer update
```

You can now start the stack by running the following command:
`docker-compose up --profile dev -d`

By default the stack will start with the following services:
- wordpress : http://localhost:8080
- phpmyadmin : http://localhost:8081
- mysql

## Notes

**Create a bedrock project**
`docker run --rm -v $(pwd):/app -u $(id -u):$(id -g) composer create-project roots/bedrock`

`docker run --rm -v $(pwd):/app -u $(id -u):$(id -g) lab_espaces_publics-apache-dev-1 wp acorn vendor:publish --provider="Log1x\Crumb\CrumbServiceProvider"`