MAKEFLAGS += --warn-undefined-variables
SHELL := bash
.SHELLFLAGS := -eu -o pipefail -c
.DEFAULT_GOAL := all
.DELETE_ON_ERROR:
.SUFFIXES:
.PHONY: _build

RM := rm
TEST := test
YES := yes
COMPOSER := composer
PHPUNIT := vendor/bin/phpunit

all:
	# tEB API: JSON schemas
	#
	# install           Install all dependencies for development
	# reinstall         Clean the working tree and install all dependencies again
	# distclean         Remove all build outputs and dependencies
	# test              Run the test suite

install:
	# Install dependencies
	@$(TEST) -d vendor || $(COMPOSER) install

reinstall: distclean install

distclean:
	# Clean all installed dependencies
	@($(TEST) -f composer.lock && $(RM) composer.lock) || true
	@($(TEST) -d vendor && $(RM) -rf vendor) || true

test: install
	# Run the test suite
	@$(PHPUNIT) -c tests/phpunit.xml
