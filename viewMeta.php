<?php
	$fir = $_POST["mtd"];
	$ft = substr($fir, 0, 4);
	$myf = 'ReadFold/mtdt.txt';
	$filecontent = file_get_contents($myf);
	$words = preg_split('/[\s]+/', $filecontent, -1, PREG_SPLIT_NO_EMPTY);
	$buffs = false;
	for($i=0; $i < count($words); $i++){
		if(strcmp($words[$i], 'START_TYPE') == 0 && strcmp($words[$i+1], $ft) == 0){
			$i = $i+2;
			$quer = "INSERT IGNORE INTO `".$ft."`(`";
			//."`, `"."`) VALUES ("
			do {
				if(strcmp($words[$i], 'startkeys') == 0){
					echo "<pre>";
					echo "</pre>";
					$buffs = true;
				} else {
					print($words[$i]);
					print(" ");
				}
				$i++;
			} while(strcmp($words[$i], 'END_TYPE') != 0);
		}
	}
	print($quer);
	
	//
?>

<html>

<head>
<title>Car Crash Data</title>

</head>

<body bgcolor="#ECDEC9" text="000000">
<font face="Times New Roman"</font>

</html>