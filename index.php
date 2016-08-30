<html>
<head>
<script type="text/javascript" src="/jquery.js"></script>
</head>

<style>
#editor {
border: 1px solid #000;
width: 800px;
height: 400px;
}
</style>

<script>
var curfile = '';

function updateFileContents(fname, contents) {
	$.post("/write.php", {fname: fname, contents: contents}, function(data) {
					console.log(data);
	})
}

function getFileContents(el) {
	$.post("/read.php", {fname: el}, function(data) {
					$('#editor').val(data);
					curfile = el;
	})
}

function getDirContents(el) {
	$.post("/list.php", {path: el}, function(data) {
	j = eval(data);

	blah = ''
	for (i=0; i<j.length; i++) {
		if (j[i].dir) {
			blah += "<a onclick=\"getDirContents('/" + el + "/" + j[i].path + "'); return false;\">"+ j[i].path + "</a><br/>";
		} else {
			blah += "<a onclick=\"getFileContents('/" + el + "/" + j[i].path + "'); return false;\">"+ j[i].path + "</a><br/>";
		}
	}
	$('#fbrowser').html(blah);
	})
}

</script>

<div id='fbrowser'>
<?php
$dir = "/";
$files = scandir($dir);

foreach ($files as &$value) {
				$abs = $dir . '/' . $value;
				if (is_dir($abs)) {
								echo "<a onclick=\"getDirContents('/$abs'); return false;\">$abs</a><br/>\n";
				} else {
								echo "<a onclick=\"getFileContents('$abs'); return false;\">$abs</a><br/>\n";
				}
}

?>
</div>

<textarea id='editor'>
</textarea>
<input type='button' value='Update' onclick='updateFileContents(curfile, $("#editor").val()); return false;'>

</html>
