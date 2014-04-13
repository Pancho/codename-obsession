#!/bin/bash

echo -n "  " &&

grep -q -P '<\?(?!php)' "$1" && echo "ERROR - shorttag found in $1" && exit 1  ||

php -l $1 && exit 0 || exit 1
