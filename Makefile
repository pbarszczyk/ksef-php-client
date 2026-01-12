DOCK_PHP = docker compose run --rm php

# wejdź do kontenera php
bash:
	$(DOCK_PHP) /bin/bash

# instalacja paczek composer-a
composer-install:
	$(DOCK_PHP) composer -o --prefer-dist install

# cs-fix
PHONY=.cs-fix
cs-fix:
	$(DOCK_PHP) vendor/bin/php-cs-fixer fix --verbose --show-progress dots

# 	rector
PHONY=.rector
rector:
	$(DOCK_PHP) vendor/bin/rector process

# 	phpstan
PHONY=.phpstan
phpstan:
	$(DOCK_WEB) vendor/bin/phpstan analyse --memory-limit 4G

PHONY=.fixers
fixers: rector cs-fix phpstan
