<?php
function printErrorCode($code, $value)
{
	printf("<tr><td align='left'>%16s</td><td align='right'>%8d</td><td align='right'>%016b</td></tr>\n", $code, $value, $value);
}
echo '<table border="1px" cellpadding="5px" cellspacing="5px">';
printErrorCode('E_ERROR', E_ERROR);
printErrorCode('E_WARNING', E_WARNING);
printErrorCode('E_PARSE', E_PARSE);
printErrorCode('E_NOTICE', E_NOTICE);
printErrorCode('E_CORE_ERROR', E_CORE_ERROR);
printErrorCode('E_CORE_WARNING', E_CORE_WARNING);
printErrorCode('E_COMPILE_ERROR', E_COMPILE_ERROR);
printErrorCode('E_COMPILE_WARNING', E_COMPILE_WARNING);
printErrorCode('E_USER_ERROR', E_USER_ERROR);
printErrorCode('E_USER_WARNING', E_USER_WARNING);
printErrorCode('E_STRICT', E_STRICT);
printErrorCode('E_ALL', E_ALL);
echo '</table>';
