<?php
output_add_rewrite_var('var1', 'value 1');
output_add_rewrite_var('var2', 'value 2');

// some links
echo '<a href="file.php">link</a><br /><a href="http://example.com">link2</a>';

// a form
echo '<form method="post"><input type="text" name="var3" /><input type="submit" /></form>';

print_r(ob_list_handlers());
echo '<p>View document source to see effect of rewrite variables</p>';
echo '<br />';
phpinfo(INFO_VARIABLES);
?>
