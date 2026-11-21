FROM wordpress:php8.2-apache

COPY docker/php.ini /usr/local/etc/php/conf.d/zz-portifoliog.ini
COPY docker/apache-security.conf /etc/apache2/conf-available/zz-portifoliog-security.conf

RUN a2enconf zz-portifoliog-security
