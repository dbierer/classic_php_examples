<?php
// Reads a MySQL or MariaDB database SQL dump and writes it to SQLite
/*
php db_pdo_mysql_to_sqlite_export.php --src=mysql --dest=sqlite --dbname=MYSQL_DBNAME
*/

// usage:
$usage = <<<EOT
Usage: php db_pdo_mysql_to_sqlite_export.php --config=CONFIG_FN [--src=mysql] [--dest=sqlite]
       NO SPACE before or after the "="
       --config    : name of the config file w/ these keys: dsn, username, password
       --src       : mysql|sqlite (default: mysql)
       --dest      : sqlite|mysql (default: sqlite)

       Config file must contain these keys:
       'mysql' => ['dbname' => DBNAME, 'user' => DB_USER, 'password' => DB_PWD],
       'sqlite' => ['file' => FULL_PATH_TO_SQLITE_FILE],
       'tables' => ['list','of','tables','to','export'],
EOT;

// look for "--" params
$arg_str = implode(' ', $argv) . ' ';
$config  = [];
$dbname  = '';
$src     = 'mysql';
$dest    = 'sqlite';

// extracts value from key
$getKeyValue = function($contents, $key, $delim) {
    $pos = strpos($contents, $key);
    if ($pos === FALSE) return '';
    $end = strpos($contents, $delim, $pos + strlen($key) + 1);
    $key = substr($contents, $pos + strlen($key), $end - $pos - strlen($key));
    if (is_string($key)) {
        $key = trim($key);
    } else {
        $key = '';
    }
    $key = trim($key);
    return $key;
};

// grab params
$configFn = $getKeyValue($arg_str, '--config=', ' ');
$src      = $getKeyValue($arg_str, '--src=', ' ') ?: 'mysql';
$dest     = $getKeyValue($arg_str, '--dest=', ' ') ?: 'sqlite';

// read config
$config = require $configFn;

// validate params
if (empty($config['mysql'])
    || empty($config['sqlite'])
    || empty($config['tables'])) exit($usage);

$opts   = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

// build MySQL connection params
$name = $config['mysql']['dbname'] ?? '';
$user = $config['mysql']['user']   ?? '';
$pwd  = $config['mysql']['password'] ?? '';
$lite = $config['sqlite']['file'] ?? '';
$list = $config['tables'] ?? [];

// validate params
if (!($name && $user && $pwd && $lite && $tables)) exit($usage);

// construct DSN for MySQL and SQLite
$myDsn   = 'mysql:host=localhost;dbname=' . $name;
$liteDsn = 'sqlite:' . $lite;

try {
    if ($src === 'mysql') {
        $src = new PDO($myDsn, $user, $pwd, $opts);
        $dest = new PDO($liteDsn);
    } else {
        $src = new PDO($liteDsn);
        $dest = new PDO($myDsn, $user, $pwd, $opts);
    }

    // loop through list of tables
    foreach ($list as $table) {
        echo "\nExporting table $table from $src to $dest\n";
        // build SELECT from $src
        $sql = 'SELECT * FROM ' . $table;
        // run SELECT query
        $query = $src->query($sql);
        $first = 0;
        $insert = '';
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            // build INSERT for $dest
            if ($first++ === 0) {
                $fields = array_keys($row);
                $insert = 'INSERT INTO ' . $table . '('
                        . implode(',', $fields)
                        . ') VALUES ( :'
                        . implode(',:', $fields)
                        . ')';
                $stmt = $dest->prepare($insert);
            }
            $stmt->execute($row);
            echo '.';
        }
    }
} catch (Throwable $t) {
    echo $t;
}
