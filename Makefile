.PHONY: build test stan docs

build:
	php src/build.php build/api.php

test:
	./vendor/bin/phpunit tests

stan:
	./vendor/bin/phpstan analyse

docs:
	php src/make-docs.php build/api.php > docs/api.md