<?php
interface ServiceInterface {
    public function getService(string $key);
    public function setService(string $key, callable $service);
}

abstract class AbstractController implements ServiceInterface {
	public const FORMAT = 'l, d M Y H:i:s';
    protected array $services = [];
}

class MvcController extends AbstractController
{
    public function getService(string $key)
    {
		return $this->services[$key] ?? NULL;
	}
    public function setService(string $key, callable $service)
    {
		$this->services[$key] = $service;
	}
}

$callback = new class () {
	protected $date = NULL;
	public function __construct()
	{
		$this->date = new DateTime('now');
	}
	public function __invoke()
	{
		return $this->date->format(AbstractController::FORMAT);
	}
};

$controller = new MvcController();
$controller->setService('date', $callback);
echo $controller->getService('date')();
