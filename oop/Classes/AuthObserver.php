<?php
namespace Classes;
use SplSubject;
use SplObserver;
class AuthObserver implements SplObserver
{
    const ERR_AUTH = 'ERROR: unauthorized';
    public function update(SplSubject $subject)
    {
        $auth_code = $subject->auth_code ?? 0;
        if ($auth_code > 0) {
            $subject->response->status = RestSubject::STATUS_OK;
        } else {
            $subject->response->status = RestSubject::STATUS_UNAUTH;
            $subject->response->data   = ['message' => self::ERR_AUTH];
        }
    }
}
