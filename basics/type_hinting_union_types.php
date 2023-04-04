<?php
// shows use of union types
// NOTE: only works in PHP 7.4 and above

/**
 * Accepts either a CSV string or an array
 *
 * @param string|array : Union type: accepts either string or array
 * @param bool $td     : TRUE == TD tag; FALSE == TH tag
 * @return string $html : returns HTML table row
 */
function get_row(array|string $data, bool $td = TRUE)
{
	$tag = ($td)
			? function ($item) { return '<td>' . $item . '</td>'; }
			: function ($item) { return '<th>' . $item . '</th>'; };
	$html = '<tr>';
	if (is_string($data)) {
		$data = str_getcsv($data);
	} elseif (!is_array($data)) {
		$data = [];
	}
	foreach ($data as $item) $html .= $tag($item);
	$html .= '</tr>' . PHP_EOL;
	return $html;
}

echo '<table>' . PHP_EOL;
echo get_row(['First','Last','DOB'], FALSE);
echo get_row('Fred,Flintstone,Caveman,0000-01-01');
echo get_row(['Wilma','Flintstone','0000-06-01']);
echo '</table>' . PHP_EOL;

// Actual output:
/*
<table>
<tr><th>First</th><th>Last</th><th>DOB</th></tr>
<tr><td>Fred</td><td>Flintstone</td><td>Caveman</td><td>0000-01-01</td></tr>
<tr><td>Wilma</td><td>Flintstone</td><td>0000-06-01</td></tr>
</table>
*/
