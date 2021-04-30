<?php
//E_ALL &~ E_Notice    ===   E_ALL ^ E_NOTICE
echo '<table>';
printf("<tr><th>E_ALL</tr><td>%032b</td></tr>\n", E_ALL);
printf("<tr><th>E_NOTICE</tr><td>%032b</td></tr>\n", E_NOTICE);
printf("<tr><th>~E_NOTICE</tr><td>%032b</td></tr>\n", ~E_NOTICE);
printf("<tr><th>E_ALL & ~E_NOTICE</tr><td>%032b</td></tr>\n",E_ALL & ~E_NOTICE);
printf("<tr><th>E_ALL ^ E_NOTICE</tr><td>%032b</td></tr>\n", E_ALL ^ E_NOTICE);
echo '</table>';