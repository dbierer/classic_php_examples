<?php
// SQLITE:
// CREATE TABLE data (id text primary key, data text, date text);
// NOTE: requires PDO and pdo_sqlite extensions
class StreamDb {
    const TABLE = 'data';
    protected $stmt, $position, $data, $url, $id, $exists;
    protected function getId($url)
    {
        $url = parse_url($url);
        $path = explode('/', $url['path']);
        $this->id = trim(array_pop($path));
    }
    public function stream_open($url, $mode)
    {
        $this->position = 0;
        $this->getId($url);
        try {
            $pdo = new PDO('sqlite://' . __DIR__ . '/test.db');
        } catch(PDOException $e) { 
            return false;
        }
        $where = ' WHERE id = ' . $pdo->quote($this->id);
        switch ($mode) {
            case 'w':
                $check = $pdo->prepare('SELECT * FROM ' . static::TABLE . $where);
                $check->execute();
                if($check->fetch()) {
                    $this->exists = true;
                    $this->stmt = $pdo->prepare('UPDATE ' . static::TABLE . ' SET data=?, date=? ' . $where);
                } else {
                    $this->stmt = $pdo->prepare('INSERT INTO ' . static::TABLE . ' VALUES (?, ?, ?)');
                }
                return true;
            case 'r':
                $this->stmt = $pdo->prepare('SELECT * FROM ' . static::TABLE . $where);
                return true;
        }
        return false;
    }
    public function stream_write($data)
    {
        $strlen = strlen($data);
        $this->position += $strlen;
        $binding = [$this->id, $data, date('Y-m-d H:m:s')];
        return $this->stmt->execute($binding) ? $strlen : null;
    }
    public function stream_read()
    {
        $this->stmt->execute();
        if($this->stmt->rowCount() == 0) return false;
        return implode(',', $this->stmt->fetch());
    }
    public function stream_tell()
    {
        return $this->id;
    }
    public function stream_eof()
    {
        return (bool) $this->stmt->rowCount();
    }
}
// An example script working with the above StreamDb class.
use StreamDb;
stream_wrapper_register('myDb', StreamDb::class);
// Stream write to a row
$id = bin2hex(random_bytes(4));
$resource = fopen('myDb://user:group@127.0.0.1/data/' . $id, 'w');
if($bytesAdded = fwrite($resource, 'cool stuff')) {
    echo $bytesAdded . ' bytes written';
}
// Stream read from a table row.
$resource = fopen('myDb://user:group@127.0.0.1/data/' . $id, 'r');
var_dump(fread($resource, 40));
