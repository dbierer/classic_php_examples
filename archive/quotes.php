<?php
define("BR","<br />\n");
$a = 'Hello';
echo BR . $a;
echo BR . '$a';
echo BR . "$a";
echo BR . "2$a";
echo BR . "$a2";
echo BR . "{$a}2";
echo BR . "\"$a\"";
echo BR . "'$a'";
echo BR . '\"$a\"';
echo BR . '\'$a\'';
echo BR . "$a is not '$a'";
echo BR . '$a is "$a"';
echo BR . 'The value of $a is ' . $a;
// Heredoc syntax
$b = <<<EOT
The value of \$a is $a

EOT;
// Nowdoc syntax (5.3+) 
// (see: http://www.php.net/manual/en/language.types.string.php#language.types.string.syntax.nowdoc)
echo BR . $b;
$b = <<<'EOT'
The value of \$a is $a
EOT;
echo BR . $b;
?>