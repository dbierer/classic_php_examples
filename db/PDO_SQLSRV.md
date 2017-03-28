#PHP PDO Access to Microsoft SQL Server from Ubuntu 16.04

This document details how to get access to a Microsoft SQL Server database using `pdo_sqlsrv`

##Before You Start

- Read these two documents:
[https://docs.microsoft.com/en-us/azure/sql-database/sql-database-develop-php-simple](https://docs.microsoft.com/en-us/azure/sql-database/sql-database-develop-php-simple)
[https://github.com/Microsoft/msphpsql/issues/213](https://github.com/Microsoft/msphpsql/issues/213)

- Now run these commands:
```
sudo curl https://packages.microsoft.com/keys/microsoft.asc | sudo apt-key add -
curl https://packages.microsoft.com/config/ubuntu/16.04/prod.list > mssql-release.list
sudo mv mssql-release.list /etc/apt/sources.list.d
sudo apt-get update
sudo ACCEPT_EULA=Y apt-get install msodbcsql unixodbc-dev
sudo apt-get install php7.1-dev 
sudo apt-get install autoconf
sudo pecl install sqlsrv-4.1.6.1
sudo pecl install pdo_sqlsrv-4.1.6.1
```
- Confirm ODBC driver installation:
```
odbcinst -q -d -n "ODBC Driver 13 for SQL Server"
```

##Update the `php.ini` file
- Run `php --ini` to find the path to your `php.ini` file
- Add these two lines to `/path/to/php.ini`
```
extension=sqlsrv.so
extension=pdo_sqlsrv.so
```
- Run `php -i` to confirm SQLSRV support was added
- NOTE: extensions (on my computer) were installed here: `/usr/local/lib/php/extensions/no-debug-non-zts-20160303/`

##Windows Side MSSQL Management
- Started SQL Server
- Started SQL Server Agent
  - Made `TCP/IP` was enabled under `SQL Native Client - Client Protocols` 
- Started SQL Server Browser (not sure if needed but started it anyway)
- Create / assign permissions to a database user for target database
  - See: [https://docs.microsoft.com/en-us/sql/relational-databases/security/authentication-access/create-a-database-user](https://docs.microsoft.com/en-us/sql/relational-databases/security/authentication-access/create-a-database-user)
- Set authentication to `SQL Server and Windows` authentication mode
- Test user access directly on the Windoze server running MSSQL:
```
sqlcmd -S ip_address -U username -P password -d database -q "select * from table_name"
```

##Sample PHP Code
- Formulate the correct DSN (Data Source Name):
  - See: [http://php.net/manual/en/ref.pdo-sqlsrv.connection.php](http://php.net/manual/en/ref.pdo-sqlsrv.connection.php)
