<?php

$fname = $_POST["fname"];

$myfile = fopen($fname, "r") or die("Unable to open file!");
echo fread($myfile,filesize($fname));
fclose($myfile);
?>
