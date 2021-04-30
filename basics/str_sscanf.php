<?php
$str = '12345';
var_dump(sscanf($str, "%d"));
var_dump(sscanf($str, "%d%d%d%d%d"));
var_dump(sscanf($str, "%1d%1d%1d%1d%1d"));
