
FROM jdecode/kode:0.3

RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

ARG _APP_KEY
ENV APP_KEY=${_APP_KEY}

COPY . .

RUN composer install -n --prefer-dist

#RUN php artisan migrate --force

RUN chown -R www-data:www-data storage bootstrap
