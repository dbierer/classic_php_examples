<?php
$days = array('Mon' => array('name' => 'Monday', 'attendance' => 200, 'list' => array('Joe', 'Fred')), 
			  'Tue' => array('name' => 'Tuesday',  'attendance' => 200),
			  'Wed' => array('name' => 'Wednesday',  'attendance' => 200),
			  'Thu' => array('name' => 'Thursday', 'attendance' => 200)
		);

$code ='Mon';
printf('%s: attendance: %d',$days[$code]['name'], $days[$code]['attendance']);
echo $days[$code]['list'][0]; 
echo (isset($days['Tue']['list'][0])) ? 'SET' : 'NOT';