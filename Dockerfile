FROM php:8.3-apache

# Installer les dépendances système et extensions PHP nécessaires
RUN apt-get update && apt-get install -y --no-install-recommends \
    sqlite3 \
    libsqlite3-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_sqlite pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Activer les modules Apache mod_rewrite et mod_headers
RUN a2enmod rewrite headers

# Configurer le DocumentRoot vers /var/www/html/public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Autoriser les directives .htaccess dans Apache
RUN sed -i '/<Directory \${APACHE_DOCUMENT_ROOT}>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf || true
RUN echo '<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>' > /etc/apache2/conf-available/webacademy.conf \
    && a2enconf webacademy

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier l'intégralité du projet
COPY . /var/www/html/

# Créer les dossiers de données et temporaires avec les bons droits
RUN mkdir -p /var/www/html/data /tmp/webacademy_run \
    && chown -R www-data:www-data /var/www/html /tmp/webacademy_run \
    && chmod -R 775 /var/www/html/data /tmp/webacademy_run

EXPOSE 80

CMD ["apache2-foreground"]
