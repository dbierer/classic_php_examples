# MongoDB 4 Sample PHP Programs
These examples are from the book *MongoDB 4 Quick Start Guide* by Doug Bierer published by Packt

## IMPORTANT
When adding a purchase, transaction support is enabled for this demo to work, you MUST configure your server as part of a replica set
* See: https://docs.mongodb.com/manual/core/transactions/#transactions-and-replica-sets
* See: https://docs.mongodb.com/manual/tutorial/deploy-replica-set-for-testing/#deploy-a-replica-set-for-testing-and-development

## To Run This Demo

### Install MongoDB 4 (see the book for more info)
* Install MongoDB 4
* Restore from backup: `restore_data_from_backup.sh`

### Install the PHP mongodb extension
* Install PHP 7.2 CLI + dev library:
```
sudo apt-get install php7.2-cli php7.2-dev
```
* Install PHP MongoDB extension: http://php.net/manual/en/mongodb.installation.pecl.php
    * Install PECL
```
sudo apt-get install php-pear
```
    * Install PHP mongodb driver with SSL support
```
sudo pecl channel-update pecl.php.net
sudo pecl install mongodb
```

### Install the PHP MongoDB Library:
```
wget https://getcomposer.org/composer.phar
php composer.phar install
```

### If you want to use transactions
* Configure `mongod` as a member of a replica set
* For testing and development you can configure your `mongod` instance as a single server replica set
* `/etc/mongod.conf` file:
```
# mongod.conf

storage:
  dbPath: /var/lib/mongodb
  journal:
    enabled: true

systemLog:
  destination: file
  logAppend: true
  path: /var/log/mongodb/mongod.log

replication:
  replSetName: "sweets_11"

net:
  port: 27017
  bindIp: 0.0.0.0

```

### If you want to test using x.509 certificates + security
* Generate a self-signed certificate
* Generate a certificate PEM for the `mongod` instance
* Generate a certificate PEM for a client
* `/etc/mongod.conf` file:
```
# mongod.conf

storage:
  dbPath: /var/lib/mongodb
  journal:
    enabled: true

systemLog:
  destination: file
  logAppend: true
  path: /var/log/mongodb/mongod.log

net:
  port: 27017
  bindIp: 0.0.0.0

net:
   ssl:
      mode: requireSSL
      PEMKeyFile: /etc/ssl/mongod.pem
      PEMKeyPassword: "password"
      CAFile: /etc/ssl/ca.pem

security:
   authorization: enabled

setParameter:
   authenticationMechanisms: PLAIN,SCRAM-SHA-256,MONGODB-X509

```
* Comment out `security.authorization` config option
* Restart `mongod`
```
sudo service mongod restart
```
* Run `mongo` shell as local user
* Create `admin` user
* Create user `zed` in `admin` database with `readWrite` privileges to `sweetscomplete`

### Copy Config Files
* Copy files depending on which demo you want to run:
| If You Want ... | Copy This File ...                      | To This Location ...     |
|-----------------|-----------------------------------------|--------------------------|
|No Security      | `./files/init_no_auth.php`              | `./Application/init.php` |
|No Transactions  | `./files/mongo_no_auth.conf`            | `/etc/mongod.conf`       |
|                 | `./files/add_no_auth.php`               | `./public/add.php`       |
|                 |                                         |                          |
|Security         | `./files/init_with_transactions.php`    | `./Application/init.php` |
|No Transactions  | `./files/mongo_with_transactions.conf`  | `/etc/mongod.conf`       |
|                 | `./files/add_with_transactions.php`     | `./public/add.php`       |
|                 |                                         |                          |
|Security         | `./files/init_with_auth.php`            | `./Application/init.php` |
|Transactions     | `./files/mongo_with_auth.conf`          | `/etc/mongod.conf`       |
|                 | `./files/add_with_auth.php`             | `./public/add.php`       |
  * This chart assumes you are running Ubuntu/Debian Linux.
  * If that is not the case, you will need to adjust the file copy destination location.

* Restart `mongod`
```
sudo service mongod restart
```

### Run the Demo
* Invoke the built-in PHP webserver in a terminal window from this directory:
```
php -S localhost:9999 -t public
```
* From a browser: http://localhost:9999
* Look at the terminal window with the local PHP webserver for errors
