FROM debian:11.6-slim  AS base

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update -y && apt-get install -y --no-install-recommends apt-utils

RUN apt-get install -y \
		openssl \
		curl \
		vim \
		telnet \
		wget \
		tcpdump \
		git \
		net-tools \
		zip \
		unzip \
		procps \
		sysstat

RUN apt install -y apt-transport-https lsb-release ca-certificates
RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list
RUN apt update

RUN apt-get install -y --no-install-recommends \
		php8.2 \
		php8.2-cli \
		php8.2-common \
		php8.2-curl \
		php8.2-gd \
		php8.2-mbstring \
		php8.2-mysql \
		php8.2-opcache \
		php8.2-readline \
		php8.2-xml \
		php8.2-fpm \
        php8.2-dev \
		php8.2-memcached

RUN curl -sL https://deb.nodesource.com/setup_19.x | bash -
RUN apt-get install -y nodejs

RUN apt-get autoclean && apt-get -y autoremove

RUN curl -sS  https://getcomposer.org/installer | php && \
    chmod +x composer.phar && mv composer.phar /usr/local/bin/composer

RUN cp /etc/php/8.2/fpm/php.ini /etc/php/8.2/fpm/php.ini.default
COPY ./infra/docker/php/php.ini /etc/php/8.2/fpm/php.ini
RUN cp /etc/php/8.2/fpm/php-fpm.conf /etc/php/8.2/fpm/php-fpm.conf.default
COPY ./infra/docker/php/php-fpm.conf /etc/php/8.2/fpm/php-fpm.conf
RUN cp /etc/php/8.2/fpm/pool.d/www.conf /etc/php/8.2/fpm/pool.d/www.conf.default
COPY ./infra/docker/php/www.conf /etc/php/8.2/fpm/pool.d/www.conf

COPY ./infra/docker/php/docker-php-entrypoint /usr/local/bin/
RUN chmod 700 /usr/local/bin/docker-php-entrypoint
ENTRYPOINT ["docker-php-entrypoint"]

VOLUME /workspace
VOLUME /var/run/php-fpm

WORKDIR /workspace

FROM base AS development

EXPOSE 5173
RUN apt-get update
RUN apt-get install -y --no-install-recommends php8.2-xdebug
COPY ./infra/docker/php/xdebug.ini /etc/php/8.2/fpm/conf.d/20-xdebug.ini

CMD ["/bin/bash","-c","php-fpm8.2"]

FROM base AS deploy

COPY ./src /workspace
COPY ./src/.env.production /workspace/.env

RUN npm ci
RUN npm run build

RUN composer install -q -n --no-ansi --no-dev --no-scripts --no-progress --prefer-dist
RUN chmod -R 777 storage bootstrap/cache

CMD ["/bin/bash","-c","php artisan optimize:clear && php artisan optimize && php-fpm8.2"]
