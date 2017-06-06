<?php
// ORIGINAL mysql extension: doesn't work in PHP 7.0 and above!!!
// MySQL parameters
$mysql_host = "localhost";
$mysql_database = "zend";
$mysql_user = "zend";
$mysql_password = "password";
// Connect and test
$dbh = mysql_connect($mysql_host,$mysql_user,$mysql_password);
if ($dbh) {
    // Select database
    mysql_select_db($mysql_database,$dbh);
    // Perform SQL query
    $sql = "SELECT * FROM products";
    $sth = mysql_query($sql);
    // Parse through result set
    echo "<table border=1>";
    // mysql_fetch_array(resource,[MSQL_ASSOC | MSQL_NUM | MSQL_BOTH])
    while ($row = mysql_fetch_assoc($sth)) {
        echo "<tr><td>";
        echo '</td><td>';
        var_dump($row);
        echo "</td></tr>\n";
    }
    echo "</table>\n";
    // Close the handle
    mysql_close($dbh);
} else {
    // Report an any error
    echo mysql_error();
}
?>
