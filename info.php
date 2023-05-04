<?php

echo shell_exec("composer update && php artisan config:cache &&  php artisan config:clear");