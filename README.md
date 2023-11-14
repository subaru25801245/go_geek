# docker-laravel 🐳 - go_geek

<p align="center">
    <img src="https://user-images.githubusercontent.com/35098175/145682384-0f531ede-96e0-44c3-a35e-32494bd9af42.png" alt="docker-laravel">
</p>
<p align="center">
    <img src="https://github.com/ucan-lab/docker-laravel/actions/workflows/laravel-create-project.yml/badge.svg" alt="Test laravel-create-project.yml">
    <img src="https://github.com/ucan-lab/docker-laravel/actions/workflows/laravel-git-clone.yml/badge.svg" alt="Test laravel-git-clone.yml">
    <img src="https://img.shields.io/github/license/ucan-lab/docker-laravel" alt="License">
</p>

## 初めに

docker-composeでシンプルなlaravel開発環境を構築。Windows(WSL2)、macOS(M1)、Linuxに対応。

## アプリの対象者

### エンドユーザー
このソフトウェアは、堅牢で柔軟なウェブアプリケーションフレームワークを求める個人や組織向けに設計されています。特に以下の点を目指す方々に有益です：

- 現代的でフル機能を備えたウェブアプリケーションの開発
- 新しいアイデアの迅速なプロトタイピング
- モバイルやシングルページアプリケーション向けのRESTful APIの構築

### 開発者向け
LaravelおよびDockerの愛好家は、このプロジェクトをアプリケーション作成の優れた出発点として見つけるでしょう。また、以下にも適しています：

- Docker化された環境を好む開発者
- 一貫した開発セットアップを必要とするチーム.
- Docker統合Laravelフレームワークを進化させたいと考える貢献者

## プロジェクトの目標

このソフトウェアの主な目標は以下の通りです：

- 異なるプラットフォームの開発者にアクセスしやすいように、DockerベースのLaravel開発セットアップを提供し、簡素化します
- Windows（WSL2）、macOS（M1）、LinuxでLaravelを使用する開発者に対して、互換性の高さと使いやすさを保証します
- Docker内のLaravelアプリケーションの機能とパフォーマンスを向上させる貢献が促進される環境を育成します

プロジェクトのビジョンは、開発プロセスを初期セットアップからデプロイメントまで簡素化し、開発者がユニークな機能の作成にもっと集中し、開発環境の構成にかける時間を減らすことを可能にすることです


## 使用方法

### Laravelのインストール

1. [こちらのテンプレートを使用します](https://github.com/ucan-lab/docker-laravel/generate)
2. gitのクローンとディレクトリを変更
3. 以下のコマンドを実行してください

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

### Laravelのセットアップ

1. gitのクローンとディレクトリを変更
2. 以下のコマンドを実行してください

```bash
$ make install
```

http://localhost


## 機能

### Open Graph Data Utilization

- **ウェブ情報収集&表示**: Open Graphプロトコルを活用して、アプリケーションはウェブページから重要なメタデータを収集し、アプリ内で表示できます。これにより、ソーシャルメディアプラットフォーム上でのコンテンツ共有と視認性が向上します

### GitHubでのソーシャルログイン

- **GitHub認証**: OAuthを実装することにより、ユーザーは自分のGitHubアカウントで簡単にサインインでき、ログインプロセスを簡素化し、セキュリティを向上させます

### お気に入り機能

- **ユーザーのお気に入り**: ユーザーは記事、投稿をお気に入りとしてマークでき、いつでも好みのコンテンツに迅速にアクセスすることが可能です

### ハッシュタグ機能

- **ダイナミックハッシュタグ**: このアプリケーションはハッシュタグ機能をサポートしており、ユーザーがコンテンツを効果的にタグ付けし、検索することを可能にし、その結果、コンテンツの発見性を向上させます

## ヒント

- [ファイルの作成方法](https://github.com/ucan-lab/docker-laravel/blob/main/Makefile).
- [laravelのウィキペディア](https://github.com/ucan-lab/docker-laravel/wiki).

## コンテナの構造

```bash
├── app
├── web
└── db
```

### アプリケーションコンテナ

- Base image
  - [php](https://hub.docker.com/_/php):8.1-fpm-bullseye
  - [composer](https://hub.docker.com/_/composer):2.2

### ウェブコンテナ

- Base image
  - [nginx](https://hub.docker.com/_/nginx):1.22

### データベースコンテナ

- Base image
  - [mysql/mysql-server](https://hub.docker.com/r/mysql/mysql-server):8.0

### メールホッグコンテナ

- Base image
  - [mailhog/mailhog](https://hub.docker.com/r/mailhog/mailhog)
