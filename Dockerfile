FROM composer
FROM php:fpm-alpine3.7

ENV WORKPATH "/var/www/behat"

RUN set -xe \
          	&& apk add --no-cache --virtual \
          		$PHPIZE_DEPS \
          		zlib-dev \
          		gnupg \
          		graphviz

RUN apk add --no-cache --virtual build-dependencies icu-dev postgresql-dev icu-dev \
                libxml2-dev freetype-dev libpng-dev libjpeg-turbo-dev g++ make autoconf \
          	&& pecl install apcu mongodb xdebug \
            && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
            && docker-php-ext-install pdo_mysql opcache json pdo_pgsql pgsql mysqli intl pdo_pgsql zip \
            && docker-php-ext-enable apcu mysqli mongodb.so xdebug

RUN apk add --no-cache --virtual git
RUN apk add --no-cache --virtual openssh-client

COPY docker/php/conf/php.ini /usr/local/etc/php/php.ini

# COPY conf/production/php.ini /usr/local/etc/php/php.ini -> Only for production usage.

# Composer
ENV COMPOSER_ALLOW_SUPERUSER 1
COPY --from=0 /usr/bin/composer /usr/bin/composer

# Blackfire (Docker approach) & Blackfire Player
RUN version=$(php -r "echo PHP_MAJOR_VERSION.PHP_MINOR_VERSION;") \
    && curl -A "Docker" -o /tmp/blackfire-probe.tar.gz -D - -L -s https://blackfire.io/api/v1/releases/probe/php/alpine/amd64/$version \
    && tar zxpf /tmp/blackfire-probe.tar.gz -C /tmp \
    && mv /tmp/blackfire-*.so $(php -r "echo ini_get('extension_dir');")/blackfire.so \
    && printf "extension=blackfire.so\nblackfire.agent_socket=tcp://blackfire:8707\n" > $PHP_INI_DIR/conf.d/blackfire.ini \
    && mkdir -p /tmp/blackfire \
    && curl -A "Docker" -L https://blackfire.io/api/v1/releases/client/linux_static/amd64 | tar zxp -C /tmp/blackfire \
    && mv /tmp/blackfire/blackfire /usr/bin/blackfire \
    && rm -Rf /tmp/blackfire

# PHP-CS-FIXER & Deptrac
RUN wget http://cs.sensiolabs.org/download/php-cs-fixer-v2.phar -O php-cs-fixer \
    && chmod a+x php-cs-fixer \
    && mv php-cs-fixer /usr/local/bin/php-cs-fixer \
    && curl -LS http://get.sensiolabs.de/deptrac.phar -o deptrac.phar \
    && chmod +x deptrac.phar \
    && mv deptrac.phar /usr/local/bin/deptrac

RUN mkdir -p ${WORKPATH}

RUN rm -rf ${WORKDIR}/vendor \
    && ls -l ${WORKDIR}

RUN mkdir -p \
		${WORKDIR}/var/cache \
		${WORKDIR}/var/logs \
		${WORKDIR}/var/sessions \
	&& chown -R www-data ${WORKDIR}/var \
	&& chown -R www-data /tmp/

RUN chown www-data:www-data -R ${WORKPATH}

WORKDIR ${WORKPATH}

COPY . ./

EXPOSE 9000

CMD ["php-fpm"]
