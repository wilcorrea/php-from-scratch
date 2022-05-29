#!/usr/bin/make

.DEFAULT_GOAL := help

##@ Docker helpers

bash:
	docker-compose exec --user application php-from-scratch bash

##@ Composer

autoload:
	docker-compose exec --user application php-from-scratch composer dump-autoload

##@ Docs

help: ## Print the makefile help
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2 } /^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } ' $(MAKEFILE_LIST)
