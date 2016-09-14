<?php
class Controllers_Index
{
	protected $view;
	
	public function index()
	{
		$this->view->head['title'] = '<title>Main</title>';
		$this->view->body['test'] = '<h1>MAIN</h1>';
		$this->view->body['message'] = 'Some Message';
	}
	public function test()
	{
		$this->view->head['title'] = '<title>Test</title>';
		$this->view->body['test'] = '<h1>TEST</h1>';
		$this->view->body['message'] = 'Test Message';
	}
	public function setView($view)
	{
		$this->view = $view;
	}
}