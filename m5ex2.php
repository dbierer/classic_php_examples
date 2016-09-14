<h1>Original</h1>
<p>
<?php $contents = file_get_contents('myfile.txt'); ?>
<?php echo $contents; ?>
</p>
<h1>Modified</h1>
<p>
<?php echo preg_replace('/C\+\+|Java/i', 'PHP', $contents); ?>
</p>