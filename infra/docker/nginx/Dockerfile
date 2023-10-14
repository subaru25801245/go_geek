FROM nginx:1.22

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
		sysstat \
		procps

# clear apt cache and remove unnecessary packages
RUN apt-get autoclean && apt-get -y autoremove

COPY ./infra/docker/nginx/default.conf /etc/nginx/conf.d/default.conf
RUN cp /etc/nginx/nginx.conf /etc/nginx/nginx.conf.default
COPY ./infra/docker/nginx/nginx.conf /etc/nginx/nginx.conf
