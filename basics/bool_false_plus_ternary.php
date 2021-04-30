<?php 
// All FALSE
echo (0) ? 'T' : 'F';
echo ('') ? 'T' : 'F';
echo (NULL) ? 'T' : 'F';
echo ('0') ? 'T' : 'F';
// Anything else is TRUE
?>