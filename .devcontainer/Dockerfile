# ベースイメージを指定します。ここではPHPの公式イメージを使用しています。
FROM mcr.microsoft.com/vscode/devcontainers/php:8.1

# SQLiteをインストールします。
RUN apt-get update && apt-get install -y sqlite3 libsqlite3-dev

# Laravelの作業ディレクトリを設定します。
WORKDIR /workspace

# 必要なLaravelファイルをコピーします。
COPY . /workspace

# Composerをインストールし、Laravelの依存関係をインストールします。
RUN composer install

# PHPの拡張機能をインストールします。
RUN docker-php-ext-install pdo pdo_sqlite
