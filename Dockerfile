FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    msmtp

RUN docker-php-ext-install pdo pdo_pgsql zip

# Install Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Get latest Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Add Composer to the PATH
ENV PATH="$PATH:/usr/local/bin"

RUN a2enmod rewrite

COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN echo 'SetEnvIf APACHE_DOCUMENT_ROOT "^(.+)$" APACHE_DOCUMENT_ROOT=$1' >> /etc/apache2/apache2.conf

# Configure PHP to use msmtp for mail()
RUN echo "sendmail_path = /usr/bin/msmtp -t" >> /usr/local/etc/php/php.ini

# Create msmtp config to route mail to MailHog
RUN echo "defaults\n\
auth off\n\
tls off\n\
logfile /var/log/msmtp.log\n\
\n\
account default\n\
host mailhog\n\
port 1025\n\
from dev@example.test\n" > /etc/msmtprc

RUN chmod 600 /etc/msmtprc && chown www-data:www-data /etc/msmtprc

WORKDIR /var/www/html

RUN chmod 755 /var/www/html

CMD ["apache2-foreground"]
