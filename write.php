<?php

$fname = $_POST["fname"];
$contents = $_POST["contents"];

$myfile = fopen($fname, "w") or die("Unable to open file!");
fwrite($myfile, $contents);
fclose($myfile);
?>
