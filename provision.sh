#!/usr/bin/env bash

#Variables
DBHOST='etglobaldev.com'
DBPW='root'

#INSTALL TOOLS
sudo apt-get update
sudo apt-get install -y apache2 php5 php5-common libapache2-mod-php5 php5-cli php-apc php5-mysql
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password $DBPW"
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $DBPW"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/dbconfig-install boolean true"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/app-password-confirm password $DBPW"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/admin-pass password $DBPW"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/app-pass password $DBPW"
sudo apt-get install -y mysql-server-5.5 phpmyadmin
sudo echo "Include /etc/phpmyadmin/apache.conf" >> /etc/apache2/apache2.conf

# CREATE DB
DBNAME='websitedb_local'

cd /var/www/html

RESULT=`sudo mysqlshow --user=root $DBNAME | grep -v Wildcard | grep -o $DBNAME`

if [ "$RESULT" == $DBNAME ]
  then
    echo 'Database already installed.'
  else
    echo "$RESULT - $DBNAME"
    echo "Database $DBNAME not yet installed... installing using mysql"

    mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS $DBNAME;"
    mysql -uroot -proot $DBNAME < /var/www/html/websitedb.sql
fi

sudo apt-get install -y openssl

# APACHE CONFIG HTTP
sudo rm /etc/apache2/sites-enabled/000-default.conf
cat > /etc/apache2/sites-enabled/000-default.conf <<EOF
<VirtualHost *:80>
    ServerName $DBHOST
    ServerAdmin support@etglobaldev.com
    DocumentRoot /var/www/html
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF

# CREATE CERTIFICATE
cd /etc/ssl
sudo mkdir /etc/apache2/ssl
sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/apache2/ssl/apache.key -out /etc/apache2/ssl/apache.crt -subj "/C=FR/ST=Paris/L=Paris/O=Socialshaker/OU=IT Department/CN=$DBHOST"
sudo chmod o-rw /etc/apache2/ssl/apache.key

# CONFIG SSL
cat > /etc/apache2/sites-enabled/default-ssl.conf <<-EOF
<IfModule mod_ssl.c>
    <VirtualHost *:443>
        ServerAdmin support@etglobaldev.com
        ServerName $DBHOST
        ServerAlias $DBHOST
        DocumentRoot /var/www/html
        <Directory />
                Options FollowSymLinks
                AllowOverride All
        </Directory>
        <Directory /var/www/html/>
                Options Indexes FollowSymLinks MultiViews
                AllowOverride All
                Order allow,deny
                allow from all
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
        SSLEngine on
        SSLCertificateFile /etc/apache2/ssl/apache.crt
        SSLCertificateKeyFile /etc/apache2/ssl/apache.key
    </VirtualHost>
</IfModule>

EOF

#ENABLE MODES
sudo a2enmod rewrite
sudo a2enmod ssl

rm /var/www/html/index.html

sudo service apache2 restart