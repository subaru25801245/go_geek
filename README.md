# docker-laravel 🐳 - go_geek

<p align="center">
    <img src="https://user-images.githubusercontent.com/35098175/145682384-0f531ede-96e0-44c3-a35e-32494bd9af42.png" alt="docker-laravel">
</p>
<p align="center">
    <img src="https://github.com/ucan-lab/docker-laravel/actions/workflows/laravel-create-project.yml/badge.svg" alt="Test laravel-create-project.yml">
    <img src="https://github.com/ucan-lab/docker-laravel/actions/workflows/laravel-git-clone.yml/badge.svg" alt="Test laravel-git-clone.yml">
    <img src="https://img.shields.io/github/license/ucan-lab/docker-laravel" alt="License">
</p>

## Introduction

Build a simple laravel development environment with docker-compose. Compatible with Windows(WSL2), macOS(M1) and Linux.

## Target Audience

### End Users
This software is designed for individuals and organizations seeking a robust and flexible web application framework. It is particularly beneficial for those looking to:

- Develop modern, full-featured web applications.
- Rapidly prototype new ideas.
- Build RESTful APIs for mobile or single-page applications.

### Developers
Laravel and Docker enthusiasts will find this project an excellent starting point for crafting their applications. It is also suitable for:

- Developers who prefer a Dockerized environment.
- Teams that require a consistent development setup.
- Contributors interested in advancing a Docker-integrated Laravel framework.

By providing clear descriptions, potential users and developers can immediately identify if the project fits their needs or expertise.

## Project Goals

The primary goals of this software are to:

- Provide a streamlined, Docker-based setup for Laravel development, making it accessible for developers across different platforms.
- Ensure a high level of compatibility and ease-of-use for developers working with Laravel on Windows (WSL2), macOS (M1), and Linux.
- Foster an environment where contributions can enhance the capabilities and performance of Laravel applications within Docker.

Our vision is to simplify the development process, from initial setup to deployment, enabling developers to focus more on creating unique features and less on configuring their development environment.


## Usage

### Laravel install

1. Click [Use this template](https://github.com/ucan-lab/docker-laravel/generate)
2. Git clone & change directory
3. Execute the following command

```bash
$ mkdir -p src
$ docker compose build
$ docker compose up -d
$ docker compose exec app composer create-project --prefer-dist laravel/laravel .
$ docker compose exec app php artisan key:generate
$ docker compose exec app php artisan storage:link
$ docker compose exec app chmod -R 777 storage bootstrap/cache
$ docker compose exec app php artisan migrate
```

http://localhost

### Laravel setup

1. Git clone & change directory
2. Execute the following command

```bash
$ make install
```

http://localhost


## Features

This Laravel application includes several key features that enhance the user experience and developer workflow:

### Open Graph Data Utilization

- **Web Information Collection & Display**: Leveraging Open Graph protocol, the application can collect essential metadata from web pages and display it within the app. This enhances content sharing and visibility on social media platforms.

### Social Login via GitHub

- **GitHub Authentication**: Implementing OAuth, users can easily sign in with their GitHub accounts, streamlining the login process and improving security.

### Favorites Functionality

- **User Favorites**: Users can mark articles, posts, or any content as favorites, allowing them to quickly access their preferred content at any time.

### Hashtagging

- **Dynamic Hashtagging**: The application supports hashtag functionality, enabling users to tag and search content effectively, thereby improving the discoverability of the content.

Remember to tailor the features to reflect the actual functionality and benefits of your application accurately.


## Tips

- Read this [Makefile](https://github.com/ucan-lab/docker-laravel/blob/main/Makefile).
- Read this [Wiki](https://github.com/ucan-lab/docker-laravel/wiki).

## Container structures

```bash
├── app
├── web
└── db
```

### app container

- Base image
  - [php](https://hub.docker.com/_/php):8.1-fpm-bullseye
  - [composer](https://hub.docker.com/_/composer):2.2

### web container

- Base image
  - [nginx](https://hub.docker.com/_/nginx):1.22

### db container

- Base image
  - [mysql/mysql-server](https://hub.docker.com/r/mysql/mysql-server):8.0

### mailhog container

- Base image
  - [mailhog/mailhog](https://hub.docker.com/r/mailhog/mailhog)
