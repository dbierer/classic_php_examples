<?php
namespace Classes;
use SplSubject;
use SplObserver;
class LoggingObserver implements SplObserver
{
    public function update(SplSubject $subject)
    {
        error_log('ERROR LOG:' . json_encode($subject->getInfo()));
    }
}
