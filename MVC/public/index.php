<?php
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);

function __autoload($classname)
{
	$classFile = str_replace('_', DIRECTORY_SEPARATOR, $classname);
	$filename = dirname(__FILE__) . '/../application/' . $classFile . '.php';
	require_once $filename;
}

$hostInfo = explode('.', $_SERVER['HTTP_HOST']);
define('CONTAINER', $hostInfo[0]);

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

$urlInfo = parse_url($_SERVER['REQUEST_URI']);
$info = explode('/', $urlInfo['path']);
$controller = (isset($info[2]) && $info[2]) ? $info[2] : 'index';
$action = (isset($info[3]) && $info[3]) ? $info[3] : 'index';
// add safety check! i.e. use glob() to get list of allowewd controllers
$class = 'Controllers_' . ucfirst($controller);
$refClass = new ReflectionClass($class);
$controllerObj = $refClass->newInstance();
$view = new Views_Main();
$controllerObj->setView($view);
$controllerObj->$action();
echo $view->render();


