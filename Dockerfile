
FROM jdecode/kode:0.3

RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

ARG _APP_KEY
ENV APP_KEY=${_APP_KEY}
ENV APP_DB_CONNECTION='mysql'
ENV APP_DB_HOST='admino.c5myiigyg55p.ap-south-1.rds.amazonaws.com'
ENV APP_DB_PORT=3306
ENV APP_DB_DATABASE='uptimechecker'
ENV APP_DB_USERNAME='uptime'
ENV APP_DB_PASSWORD='xBKGVPCtDWOCNX4x'

COPY . .

RUN composer install -n --prefer-dist

RUN php artisan migrate --force

RUN chown -R www-data:www-data storage bootstrap
