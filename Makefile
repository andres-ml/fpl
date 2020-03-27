.PHONY: code test

code:
	php src/build.php build/api.php

test:
	./vendor/bin/phpunit tests