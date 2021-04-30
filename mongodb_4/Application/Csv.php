<?php
namespace Application;

use Exception;
use SplFileObject;
class Csv
{
    const ERROR_FILE = 'ERROR: file does not exist';
    protected $csvFile;
    protected $headers;
    public function __construct($fn)
    {
        if (!file_exists($fn)) throw new Exception(self::ERROR_FILE);
        $this->csvFile = new SplFileObject($fn, 'r');
    }
    public function getHeaders()
    {
        if (!$this->headers) {
            $this->csvFile->rewind();
            $this->headers = $this->csvFile->fgetcsv();
        }
        return $this->headers;
    }
    public function getIterator()
    {
        $this->csvFile->rewind();
        while ($line = $this->csvFile->fgetcsv()) {
            if (is_array($line)) yield $line;
        }
    }
    public function getIteratorWithHeaders()
    {
        foreach ($this->getIterator() as $line) {
            if (count($this->getHeaders()) == count($line)) {
                yield array_combine($this->getHeaders(), $line);
            }
        }
    }
}

