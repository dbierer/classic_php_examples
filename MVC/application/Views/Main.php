<?php

class Views_Main
{
	public $body = array();
	public $head = array();
	public function render()
	{
		$output = '<html>';
		$output .= '<head>';
		$output .= '<link rel="stylesheet" href="/mvc/css/styles.css" type="text/css"></link>' . PHP_EOL;
		foreach ($this->head as $item) {
			$output .= $item;
		}
		$output .= '</head>' . PHP_EOL;
		$output .= '<body>' . PHP_EOL;
		$output .= '<div><ul>'
				 . '<li><a href="/mvc/index/index">Main</a></li>'
				 . '<li><a href="/mvc/index/test">Test</a></li>'
				 . '<li><a href="/mvc/user/loginStart">Login</a></li>'
				 . '<ul></div>';
		foreach ($this->body as $item) {
			$output .= $item;
		}
		$output .= '</body>' . PHP_EOL;
		$output .= '</html>' . PHP_EOL;
		return $output;
	}
}