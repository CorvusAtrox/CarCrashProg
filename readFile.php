<?php
	$fir = $_POST["fil"];
	$filecontent = file_get_contents($fir);
	$chars = preg_split('//', $filecontent, -1, PREG_SPLIT_NO_EMPTY);
	echo "<pre>";
	print_r($chars);
	echo "</pre>";
?>