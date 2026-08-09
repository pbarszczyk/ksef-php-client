AGENT_DOCKER_COMPOSE = COMPOSE_PROGRESS=quiet docker compose --ansi never

DOCK_APP = docker compose run --rm php
DOCK_APP_AGENT = $(AGENT_DOCKER_COMPOSE) run --rm php

#================================== CONFIG ===================================#
.PHONY: start
start:
	echo 'Makefile to ksef-php-client'

#=================================== TARGETS =================================#
# 	zaloguj się do obrazu WEB docker-a jako Twój użytkownik
.PHONY: bash
bash:
	$(DOCK_APP) /bin/bash

# 	instalacja paczek composer-a
.PHONY: composer-install
composer-install:
	$(DOCK_APP) composer -o --prefer-dist install

#=================================== TESTS ===================================#
PEST_CMD = vendor/bin/pest --parallel

# 	Run all tests
.PHONY: tests
tests:
	$(DOCK_APP) $(PEST_CMD)

# 	Run a single test file or path, e.g. make tests-single TEST_FILE=tests/Unit/ClientBuilderTest.php
.PHONY: tests-single
tests-single:
	$(DOCK_APP_AGENT) $(PEST_CMD) $(TEST_FILE)

#================================== CS-FIX ===================================#
CS_FIX_CMD = vendor/bin/php-cs-fixer fix
# 	cs-fix
.PHONY: cs-fix
cs-fix:
	$(DOCK_APP) $(CS_FIX_CMD) --verbose --show-progress dots

# 	cs-fix-agent (quiet docker output, readable summary)
.PHONY: cs-fix-agent
cs-fix-agent:
	$(DOCK_APP_AGENT) $(CS_FIX_CMD) --quiet

#================================== RECTOR ===================================#
RECTOR_CMD = vendor/bin/rector process
# 	rector
.PHONY: rector
rector:
	$(DOCK_APP) $(RECTOR_CMD)

# 	rector-agent (quiet docker output, readable failures)
.PHONY: rector-agent
rector-agent:
	$(DOCK_APP_AGENT) $(RECTOR_CMD) --no-progress-bar

#=================================== PHPSTAN =================================#
PHPSTAN_CMD = vendor/bin/phpstan analyse --memory-limit 4G
PHPSTAN_AGENT_CMD = $(PHPSTAN_CMD) --no-progress --error-format=json

# 	phpstan
.PHONY: phpstan
phpstan:
	$(DOCK_APP) $(PHPSTAN_CMD)

# 	phpstan-agent
.PHONY: phpstan-agent
phpstan-agent:
	$(DOCK_APP_AGENT) $(PHPSTAN_AGENT_CMD)

# 	phpstan-scope
.PHONY: phpstan-scope
phpstan-scope:
	$(DOCK_APP_AGENT) $(PHPSTAN_CMD) $(SCOPE)

# 	phpstan-scope-agent
.PHONY: phpstan-scope-agent
phpstan-scope-agent:
	$(DOCK_APP_AGENT) $(PHPSTAN_AGENT_CMD) $(SCOPE)

#================================== FIXERS ====================================#
.PHONY: fixers
fixers: rector cs-fix phpstan

.PHONY: fixers-agent
fixers-agent: rector-agent cs-fix-agent phpstan-agent
