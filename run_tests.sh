#!/bin/sh

chmod -w tests/resource/nopermission.txt
phpunit
