.PHONY: code test

code:
	php build.php

test:
	./vendor/bin/phpunit tests