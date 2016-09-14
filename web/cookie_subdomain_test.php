<?php
// SETUP: need entries in /etc/hosts corresponding to onlinemarket.complete and post.onlinemarket.complete
// SETUP: need vhost files corresponding to onlinemarket.complete and post.onlinemarket.complete
setcookie('post', 1, time()+3600, NULL, 'post.onlinemarket.complete');
setcookie('base', 1, time()+3600, NULL, 'onlinemarket.complete');
echo '<a href="http://onlinemarket.complete/cookie_subdomain_test.php">BASE</a>';
echo '<br /><a href="http://post.onlinemarket.complete/cookie_subdomain_test.php">POST</a>';
phpinfo(INFO_VARIABLES);