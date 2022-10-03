<?php
function htmlSelectHtml( $config ) {
	$html = '';
    $html .= '<select name="gender">';
    foreach ($config['select'] as $key => $value) {
        $html .=  '<option value="' . $key . '">' . $value . '</option>';
    }
    $html .=  '</select>';
    return $html;
}
$config['select'] = ['M' => 'Male', 'F' => 'Female', 'X' => 'Other'];
$dropdown = htmlSelectHtml($config);
$title    = 'Hello World';
$name     = 'Fred Flintstone';
include __DIR__ . '/template.phtml';
