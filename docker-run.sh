#!/bin/sh

docker stop php-test
docker rm php-test
docker run --name php-test -it -v $(pwd):/var/www/html  leosarli/php71-for-test /bin/bash