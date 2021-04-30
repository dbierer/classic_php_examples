<?php
namespace Classes;
use SplSubject;
use SplObserver;
class HandlerObserver implements SplObserver
{
    const SUCCESS = 'SUCCESS: data received';
    public function update(SplSubject $subject)
    {
        if ($subject->response->status === RestSubject::STATUS_OK) {
            $subject->response->data = [
                'message' => self::SUCCESS,
                'payload' => $subject->getInfo()
            ];
        }
        header('Content-Type: application/json');
        http_response_code($subject->response->status);
        exit($subject->render());
    }
}
