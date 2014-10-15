<?php
	$fir = $_POST["fil"];
	$filecontent = file_get_contents($fir);
	$chars = preg_split('//', $filecontent, -1, PREG_SPLIT_NO_EMPTY);
	echo "<pre>";
	print_r($chars);
	echo "</pre>";
	/*$f = 0;
	$filer = fopen($fir,"r");
	while(! feof($filer)){
		$line = fgets($filer);
		while(! feof($line)){
		    printf("%d %c", $f, fgetc($line));
			$f++;
		}
	}
	fclose($filer);*/
?>

<html>

<head>
<title>Car Crash Data</title>

</head>

<body bgcolor="#ECDEC9" text="000000">
<font face="Times New Roman"</font>

</html>