<?php 
// NOTE: rewriter vars require an HTML <form> to be present
// NOTE: use arg_separator.output if > 1 rewriter var is used
ini_set('arg_separator.output', '&');
output_add_rewrite_var('ABC','DEF');
output_add_rewrite_var('XYZ', 123);
ob_start();
$value = 12345;
?>
<form action="#" method="GET">
<input type="submit" value="GET" />
</form>
<form action="#" method="POST">
<input type="submit" value="POST" />
<input type="hidden" name="test" value="<?php echo $value; ?>" />
</form>
<?php 
ob_flush();
phpinfo(INFO_VARIABLES);
?>
