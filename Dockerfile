FROM ghcr.io/liox-cz/php:8.2

ENV APP_ENV="prod"
ENV APP_DEBUG=0
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS=0

# Unload xdebug extension by deleting config
RUN rm /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

WORKDIR /app
COPY .docker/nginx-unit /docker-entrypoint.d/

# Intentionally split into multiple steps to leverage docker layer caching
COPY composer.json composer.lock ./

RUN composer install --no-dev --no-interaction --no-scripts --no-autoloader

# Copy application source code
COPY . .

RUN composer install --no-dev --no-interaction --classmap-authoritative

EXPOSE 8080

ARG APP_VERSION
ENV SENTRY_RELEASE="${APP_VERSION}"
