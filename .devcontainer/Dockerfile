# ベースイメージとしてPHP 8.2の公式イメージを使用
FROM php:8.2-cli

# 必要なシステムパッケージのインストール
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Node.jsとnpmのインストール
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# vscodeユーザーを作成し、sudo権限を付与
RUN useradd -ms /bin/bash vscode \
    && echo "vscode ALL=(ALL) NOPASSWD:ALL" >> /etc/sudoers

# 作業ディレクトリを設定
WORKDIR /workspace

# コンテナ起動時に実行するコマンドを設定
CMD ["php", "-a"]