FROM dunglas/frankenphp:php8.4

HEALTHCHECK NONE

RUN apt-get update && apt-get install -y vim-tiny \
    && printf '#!/bin/bash\necho "" > /var/www/.bash_profile\nfor v in $(bash -c "compgen -v"); do printf "export $v=\"$(printenv $v)\"\n" >> /var/www/.bash_profile; done\n' > /usr/local/bin/artisan-cron-env && \
    chmod +x /usr/local/bin/artisan-cron-env && \
    printf "SHELL=/bin/bash\nMAILTO=\"\"\n* * * * * www-data /usr/local/bin/artisan-cron\n" > /etc/cron.d/laravel && \
    printf "#!/bin/bash\nsource /var/www/.bash_profile\n/usr/local/bin/php -d memory_limit=-1 /var/www/html/artisan schedule:run --quiet > /proc/1/fd/1 2>/proc/1/fd/2\n" > /usr/local/bin/artisan-cron && \
    chmod +x /usr/local/bin/artisan-cron

#RUN install-php-extensions \
#    pcntl
#    # Add other PHP extensions here...

COPY --chown=www-data:www-data . /app

# TODO: Custom Caddyfile

USER www-data
 
CMD ["php", "artisan", "octane:frankenphp"]
