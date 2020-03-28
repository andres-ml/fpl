.PHONY: code test docs

code:
	php src/build.php build/api.php

test:
	./vendor/bin/phpunit tests

docs:
	php src/make-docs.php build/api.php > docs/api.md