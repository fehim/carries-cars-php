FROM php:7.4-alpine

RUN apk add make
RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

# Setup working directory
WORKDIR /var/cli

CMD ["php", "-a"]
