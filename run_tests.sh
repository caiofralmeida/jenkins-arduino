#!/bin/sh

chmod -w tests/resource/nopermission.txt

mkdir -p build/logs
phpunit --coverage-clover build/logs/clover.xml
