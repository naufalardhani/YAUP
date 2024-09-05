FROM php:8-apache@sha256:a1eeffd475f45e32f6c9d4895c14f2b5418b84cd1ff5aa449655a7c6e71ea94d

ENV GECKODRIVER_VERSION=0.34.0
ENV SELENIUM_VERSION=4.16.0

RUN apt-get update && \
    apt-get install --no-install-recommends -y wget postgresql-15 postgresql-client-15 postgresql-contrib-15 libpq-dev supervisor && \
    docker-php-ext-install pdo pdo_pgsql && \
    a2enmod rewrite

RUN apt-get install --no-install-recommends -y python3 python3-pip firefox-esr && \
    pip3 install selenium==${SELENIUM_VERSION} --break-system-packages --no-cache-dir && \
    su postgres -c '/usr/lib/postgresql/15/bin/pg_ctl -D /var/lib/postgresql/data initdb'

RUN wget -q https://github.com/mozilla/geckodriver/releases/download/v${GECKODRIVER_VERSION}/geckodriver-v${GECKODRIVER_VERSION}-linux64.tar.gz && \
    tar -xvzf geckodriver-v${GECKODRIVER_VERSION}-linux64.tar.gz && \
    mv geckodriver /usr/local/bin/ && \
    chmod +x /usr/local/bin/geckodriver && \
    rm geckodriver-v${GECKODRIVER_VERSION}-linux64.tar.gz

COPY ./src/ /var/www/html/
COPY ./conf/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY ./conf/website.conf /etc/apache2/sites-available/000-default.conf
COPY ./scripts/entrypoint.sh /entrypoint.sh
COPY ./scripts/readflag.c /readflag.c
COPY ./scripts/bot.py /bot.py

RUN chmod +x /entrypoint.sh && \
    gcc -o /readflag /readflag.c && \
    rm /readflag.c && \
    chmod u+s /readflag && \
    chmod 755 /bot.py && \
    mkdir /var/uploads/ && \
    chown www-data:www-data /var/uploads/

EXPOSE 80
CMD ["/entrypoint.sh"]
