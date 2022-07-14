FROM webdevops/php-nginx-dev:8.1

COPY . /var/www/app

ENV WEB_DOCUMENT_ROOT=/var/www/app/public
ENV PHP_MEMORY_LIMIT=2048M
ENV PHP_MAX_EXECUTION_TIME=86400
ENV PHP_POST_MAX_SIZE=500M
ENV PHP_UPLOAD_MAX_FILESIZE=500M
ENV APP_ENV=production

WORKDIR /var/www/app

RUN cd /var/www/app && \
  composer install --no-interaction && \
  chown application:application . -R
