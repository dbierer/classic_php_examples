<?php
$ok  = FALSE;
$num = (int) $_GET['num'];
$num = ($num > 10) ? 10 : $num;
$num = ($num < 1)  ? 1  : $num;
$location = sprintf('Location: http://php.exp/slides/PHP_ExperiencedProgrammers_MOD-%d_v6-1/player.html', $num);
header($location);
exit;
