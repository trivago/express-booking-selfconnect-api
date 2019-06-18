UID ?= $(shell id -u)
GID ?= $(shell id -g)

help:
	@echo "\e[32m Usage make [target] "
	@echo "If you want to run another version of PHP, just update the PHP_VERSION var below \e[0m"
	@echo
	@echo "\e[1m targets:"
	@egrep '^(.+)\:\ ##\ (.+)' ${MAKEFILE_LIST} | column -t -c 2 -s ':#'

test: ## Execute tests
test: test-openapi
test-openapi: ## Lint openapi file
	@docker run \
	    -t \
	    --rm \
	    --user $(UID):$(GID) \
		-v $(PWD):/app \
		-w /app \
		wework/speccy lint /app/open-api.json
.PHONY: test-openapi

doc: ## Generate api doc
	@docker run \
	    -t \
	    --rm \
	    --user $(UID):$(GID) \
		-v $(PWD):/app \
		-w /app \
		mikebell/api2html api2html -o /app/doc/index.html /app/open-api.json
.PHONY: doc
