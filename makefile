#!/usr/bin/make

# choco install make

.DEFAULT_GOAL := help

##@ Development resources

init: ## Start a new develop environment
	$(MAKE) dev
	$(MAKE) install
	$(MAKE) keys

keys: ## Generate secret keys
	docker-compose exec --user application php-from-scratch-app bash -c "php artisan key:generate"

unlog: ## Clear log file
	docker-compose exec --user application php-from-scratch-app bash -c "echo '' > storage/logs/laravel.log"


##@ Docker actions

dev: ## Start containers detached
	docker-compose up -d

logs: ## Show the output logs
	docker-compose logs

log: ## Open the logs and follow the news
	docker-compose logs --follow

restart: ## Restart all the containers
	docker-compose down
	docker-compose up -d

uncache: ## Clear the cache
	docker-compose exec --user application php-from-scratch-app bash -c "php artisan cache:clear"


##@ Bash controls

bash: ## Start nginx bash
	docker-compose exec --user application php-from-scratch-app bash

app: ## Start nginx bash
	docker-compose exec --user application php-from-scratch-app bash

queue: ## Start mysql bash
	docker-compose exec --user application php-from-scratch-queue bash


##@ Composer

install: ## Composer install dependencies
	docker-compose exec --user application php-from-scratch-app bash -c "composer install"

autoload: ## Run the composer dump
	docker-compose exec --user application php-from-scratch-app bash -c "composer dump-autoload"


##@ Docs

help: ## Print the makefile help
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2 } /^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } ' $(MAKEFILE_LIST)
