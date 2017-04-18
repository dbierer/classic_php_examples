#PHP PDO Access to Microsoft SQL Server from Ubuntu 16.04

This document details how to get access to a Microsoft SQL Server database using `pdo_sqlsrv`.

NOTE: as of this writing, was unable to get `sqlsrv` to work.

##Before You Start

- Read these two documents:
  - [https://docs.microsoft.com/en-us/azure/sql-database/sql-database-develop-php-simple](https://docs.microsoft.com/en-us/azure/sql-database/sql-database-develop-php-simple)
  - [https://github.com/Microsoft/msphpsql/issues/213](https://github.com/Microsoft/msphpsql/issues/213)

##OBDC Driver Installation
- Now run these commands:
```
sudo curl https://packages.microsoft.com/keys/microsoft.asc | sudo apt-key add -
curl https://packages.microsoft.com/config/ubuntu/16.04/prod.list > mssql-release.list
sudo mv mssql-release.list /etc/apt/sources.list.d
sudo apt-get update
sudo ACCEPT_EULA=Y apt-get install msodbcsql unixodbc-dev
sudo apt-get install php7.1-dev 
sudo apt-get install autoconf
// replace "x.y.z" with the appropriate version number
// i.e. 4.6.1
sudo pecl install pdo_sqlsrv-x.y.z
```
- Confirm ODBC driver installation:
```
odbcinst -q -d -n "ODBC Driver 13 for SQL Server"
```

##Update the `php.ini` file
- Run `php --ini` to find the path to your `php.ini` file
- Add this line to `/path/to/php.ini`
```
extension=pdo_sqlsrv.so
```
- Run `php -i` to confirm SQLSRV support was added
- NOTE: extensions (on my computer) were installed here: `/usr/local/lib/php/extensions/no-debug-non-zts-20160303/`
- To find where your extension was installed run this command:
```
sudo find / -name pdo*.so
```

##Zend Server
- Copy the `pdo_sqlsrv.so` driver file from where it was installed (see above) to: `/usr/local/zend/lib/php_extensions`
```
sudo cp /usr/local/lib/php/extensions/no-debug-non-zts-20160303/pdo_sqlsrv.so /usr/local/zend/lib/php_extensions
```
- Make sure the driver is executable:
```
sudo chmod +x /usr/local/zend/lib/php_extensions/pdo_sqlsrv.so
```
- Create a new file `/usr/local/zend/etc/conf.d/pdo_sqlsrv.ini`
- Add this line to that file:
```
extension=pdo_sqlsrv.so
```
- Restart Zend Server

##Windows Side MSSQL Management
- Started SQL Server
- Started SQL Server Agent
  - Made `TCP/IP` was enabled under `SQL Server Network Configuration | Protocols for MSSQLSERVER`
- Started SQL Server Browser (not sure if needed but started it anyway)
- Create / assign permissions to a database user for target database
  - See: [https://docs.microsoft.com/en-us/sql/relational-databases/security/authentication-access/create-a-database-user](https://docs.microsoft.com/en-us/sql/relational-databases/security/authentication-access/create-a-database-user)
- Set authentication to `SQL Server and Windows` authentication mode
- Test user access directly on the Windoze server running MSSQL:
```
sqlcmd -S ip_address -U username -P password -d database -q "select * from table_name"
```
- Open port 1433 in your firewall.  
  - If using Windows Firewall see [https://docs.microsoft.com/en-us/sql/sql-server/install/configure-the-windows-firewall-to-allow-sql-server-access](https://docs.microsoft.com/en-us/sql/sql-server/install/configure-the-windows-firewall-to-allow-sql-server-access)
  
##Test the Connection
- Install the FreeTds utils:
```
sudo apt-get install freetds-bin
```
- Test the connnection.  This example assumes the following:
  - Username = "test"
  - Password = "Password123"
  - Database = "test"
  - Host = IP address of the computer hosting SQL Server
  - Port = 1433 (default)
```
tsql -H 192.168.3.126 -U test -P Password123 -D test -p 1433
```
- SUCCESS: you will see a `1&gt;` prompt
  - NOTE: type "exit" to exit this prompt
- FAILURE: you will see an attempt count value which keeps incrementing 

##Sample PHP Code
- Formulate the correct DSN (Data Source Name):
  - See: [http://php.net/manual/en/ref.pdo-sqlsrv.connection.php](http://php.net/manual/en/ref.pdo-sqlsrv.connection.php)
```
<?php
// Database params
$tcp  = '192.168.3.126';
$port = 1433;
$user = "test";
$password = "Password123";
$database = "test";

// Open connection
try {
    // Database connect -- use one of the two statements below
    $dsn =  'sqlsrv:Server=tcp:' . $tcp . ',' . $port . ';Database=' . $database;
    $dbh = new PDO( $dsn, $user, $password, array());
    // SQL prepare
    $sql = "SELECT * FROM prospects";
    $sth = $dbh->prepare($sql);
    // Execute
    $sth->execute();
    // Fetch results
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $output = '<pre>';
        $output .= implode("\t", array_keys($row)) . PHP_EOL;
        $output .= implode("\t", $row) . PHP_EOL;
        while ($row = $sth->fetch(PDO::FETCH_NUM)) {
            $output .= implode("\t", $row) . PHP_EOL;
        }
    }
} catch (PDOException $e) {
    $output .= $e->getMessage();
}
$output .= '</pre>';
echo $output;
```
