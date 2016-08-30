<?php

$path = $_POST["path"];

$files = scandir("$path");

echo "[";

foreach ($files as &$value) {
	$abs = $dir . '/' . $value;
	if (is_dir($abs)) {
		echo '{dir: true, path: "' . $value . '"},';
	} else {
		echo '{dir: false, path: "' . $value . '"},';
	}
}

echo "]";

?>
