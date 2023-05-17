FROM php:7.4-fpm

# Set working directory
WORKDIR /var/www/html

# Instalar dependências
RUN apt-get update && apt-get install -y \
    sqlite3 \
    libsqlite3-dev \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl

RUN docker-php-ext-configure gd --with-freetype --with-jpeg=/usr/include/ --enable-gd

# Instalar extensões
RUN docker-php-ext-install mysqli pdo_mysql gd

# Instalar composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Adicionar usuário para aplicação
RUN groupadd -g 1001 www
RUN useradd -r -u 1001 -g www www

# Copiar o conteúdo do diretório de aplicativos existente
COPY . /var/www/html

# Copiar permissões existentes do diretório de aplicativos
COPY --chown=www:www . /var/www/html

# Alterar usuário atual para www
USER www
