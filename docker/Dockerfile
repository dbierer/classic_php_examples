FROM unlikelysource/php8_tips_8_1_interrim:latest
MAINTAINER doug@unlikelysource.com
COPY zend.sql /tmp/zend.sql
COPY startup.sh /tmp/startup.sh
RUN \
    echo "Creating sample database and assigning permissions ..." && \
    /etc/init.d/mysql start && \
    sleep 7 && \
    mysql -uroot -v -e "CREATE DATABASE zend;" && \
    mysql -uroot -v -e "CREATE USER 'test'@'localhost' IDENTIFIED BY 'password';" && \
    mysql -uroot -v -e "GRANT ALL PRIVILEGES ON *.* TO 'test'@'localhost';" && \
    mysql -uroot -v -e "FLUSH PRIVILEGES;" && \
    echo "Restoring sample database ..." && \
    mysql -uroot -e "SOURCE /tmp/zend.sql;" zend
RUN \
    echo "Updating Composer 2.x ..." && \
    /usr/bin/composer self-update
CMD /tmp/startup.sh
