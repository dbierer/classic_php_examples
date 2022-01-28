<?php
// Reads a MySQL or MariaDB database SQL dump and writes it to SQLite
// @TODO: INSERT statements not translating properly; need to figure out how to deal with embedded quotes
/*
Example of full export / import:
mysqldump DATABASE >mysql.sql
php db_pdo_mysql_to_sqlite_converter.php --mysql_dump=mysql.sql --create-only >sqlite.sql
cat sqlite.sql |sqlite3 sqlite.db
php db_pdo_mysql_to_sqlite_export.php --src=mysql --dest=sqlite --dbname=MYSQL_DBNAME
*/

// usage:
$usage = <<<EOT
Usage: php db_pdo_mysql_to_sqlite_converter.php --mysql_dump=MYSQL_SQL | --sqlite_db=SQLITE_DB [--create-only]
       MYSQL_SQL  : name of the MySQL/MariaDB database dump

Example of full export / import:

mysqldump DATABASE >mysql.sql
php db_pdo_mysql_to_sqlite_converter.php mysql.sql >sqlite.sql
cat sqlite.sql |sqlite3 sqlite.db

EOT;

// MySQL SQL dump filename
$mysqlFn  = $argv[1] ?? __DIR__ . '/mysql.sql';
if (empty($argv[1])) exit($usage);

// look for "--create-only"
$arg_str = implode(' ', $argv);
$createOnly = (strpos($arg_str, '--create-only') !== FALSE);

// remove lines that begin with (after leading spaces trimmed):
$remove = ['/*!', 'LOCK', 'UNLOCK', 'PRIMARY'];

// flags
$flags = [
    'CREATE' => new class () {
        const ON_COND  = 'CREATE';
        const OFF_COND = 'ENGINE';
        public $state  = 0;
        public function __invoke(string $line = '') : int
        {
            if (!empty($line)) {
                // do we turn state ON?
                if ($this->state === 0) {
                    $status = (strpos($line, self::ON_COND) !== FALSE);
                    $this->state = ($status) ? 1 : 0;
                } else {
                    $status = (strpos($line, self::OFF_COND) !== FALSE);
                    $this->state = ($status) ? 0 : 1;
                    return 1;   // allow the off condition line to pass
                }
            }
            return $this->state;
        }
    },
    'INSERT' => new class () {
        const ON_COND  = 'INSERT';
        const OFF_COND = ');';
        public $state  = 0;
        public function __invoke(string $line = '') : int
        {
            if (!empty($line)) {
                // do we turn state ON?
                if ($this->state === 0) {
                    $status = (strpos($line, self::ON_COND) !== FALSE);
                    $this->state = ($status) ? 1 : 0;
                } else {
                    $status = (strpos($line, self::OFF_COND) !== FALSE);
                    $this->state = ($status) ? 0 : 1;
                    return 1;   // allow the off condition line to pass
                }
            }
            return $this->state;
        }
    },
];

// replacements
$replace = function ($line) {
return preg_replace(
    [
        //'/\\\'/',    // Use '' instead of \'
        '/\"/',      // Use " instead of \"
        '/\\r/',     // Convert escaped \r\n to literal
        '/\\n/',     // Convert escaped \r\n to literal
        '/\\\\/',    // Convert escaped \ to literal
        '/\`/',      // Remove
        '/AUTO_INCREMENT=\d+?\s/i',    // Remove
        '/(\sint\(.+?)(AUTO_INCREMENT)/i', // Convert to AUTOINCREMENT PRIMARY KEY
    ],
    [
        //"'",        // Use '' instead of \'
        '"',        // Use " instead of \"
        "\r",       // Convert escaped \r\n to literal
        "\n",       // Convert escaped \r\n to literal
        '\\',       // Convert escaped \ to literal
        '',         // Remove "`"
        '',         // Remove "AUTO_INCREMENT"
        ' INTEGER PRIMARY KEY AUTOINCREMENT ',         // Make primary key w/ auto increment
    ],
    $line);
};

// read MySQL dump and convert
$mysql = file($mysqlFn);
$sqlite = [];

foreach ($mysql as $key => $line) {
    $ok = TRUE;
    foreach ($remove as $item) {
        if (strpos(trim($line), $item) === 0) {
            $ok = FALSE;
            break;
        }
    }
    if (!$ok) continue;
    // conditional replacements
    // look for --create-only flag
    if ($createOnly) {
        if ($flags['CREATE']($line)) {
            $sqlite[] = $replace($line);
        }
    } else {
        // general replacements
        $sqlite[] = $replace($line);
    }
}

// scan SQLite SQL dump and check for trailing commas, etc.
foreach ($sqlite as $key => $line) {
    if (stripos($line, 'ENGINE') !== FALSE) {
        $prev = $key - 1;
        if ($prev >= 0 && $key !== 0) {
            $value = trim($sqlite[$prev]);
            if (substr($value, -1) == ',') {
                $value = substr($value, 0, -1);
                $sqlite[$prev] = '  ' . $value . "\n";
            }
        }
        $sqlite[$key] = ");\n";
    }
}
echo implode('', $sqlite);

