# ベースイメージを指定
FROM mcr.microsoft.com/vscode/devcontainers/php:7.4

# SQLiteのインストール
RUN apt-get update && \
    apt-get install -y sqlite3 libsqlite3-dev && \
    docker-php-ext-install pdo pdo_sqlite

# Composerのインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 作業ディレクトリの設定
WORKDIR /workspace

# 権限の設定
RUN chown -R vscode:vscode /workspace

# 起動時に実行するコマンドを設定
CMD ["sleep", "infinity"]
