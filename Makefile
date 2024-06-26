# Makefile
MAKE := make
install:
	composer install

validate:
	composer validate

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src

fix:
	composer exec --verbose phpcbf -- --standard=PSR12 src

help:
	./gendiff -h

diff:
	./gendiff files/file1.json files/file2.json


# make help
# make diff