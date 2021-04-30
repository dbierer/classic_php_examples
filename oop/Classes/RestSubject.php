<?php
namespace Classes;
use SplSubject;
use SplObserver;
use SplObjectStorage;
class RestSubject implements SplSubject
{
    const STATUS_OK     = 200;
    const STATUS_UNAUTH = 403;
    public $uri       = '';
    public $method    = '';
    public $ip_addr   = '';
    public $auth_code = '';
    public $response  = NULL;
    public $observers = NULL;
    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $this->ip_addr = $_SERVER['REMOTE_ADDR'] ?? '';
        $this->auth_code = $_GET['auth_code'] ?? 0;
        $this->request = $_REQUEST ?? [];
        $this->response = new Response();
        $this->observers = new SplObjectStorage;
    }

    public function attach(SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
    public function getInfo()
    {
        return [
            'uri' => $this->uri,
            'method' => $this->method,
            'ip_addr' => $this->ip_addr,
            'auth_code' => $this->auth_code,
            'request' => $this->request
        ];
    }
    public function render()
    {
        return json_encode($this->response);
    }
}
