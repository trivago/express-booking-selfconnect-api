UID ?= $(shell id -u)
GID ?= $(shell id -g)
COMPOSER := docker run \
			--rm \
			--volume $(CURDIR):/app \
			--user $(UID):$(GID) \
			 composer

help:
	@echo "\e[32m Usage make [target] "
	@echo "If you want to run another version of PHP, just update the PHP_VERSION var below \e[0m"
	@echo
	@echo "\e[1m targets:"
	@egrep '^(.+)\:\ ##\ (.+)' ${MAKEFILE_LIST} | column -t -c 2 -s ':#'


install: ## Will install the dependencies in the vendor folder with composer docker image
	@echo "\033[1;36m Running COMPOSER \e[0m "
	@$(COMPOSER) install --ignore-platform-reqs --no-scripts
.PHONY: install

clean: ## Will composer.lock and the vendor folder
	@rm -f composer.lock && rm -rf vendor || true
.PHONY: clean

test: ## Will run the test inside the composer docker image
test: install
	@$(COMPOSER) run-script test
.PHONY: test

.DEFAULT_GOAL := help