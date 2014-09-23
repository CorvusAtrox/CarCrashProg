<?php
$dir = $_POST["folder"];
if (is_dir($dir)){
  if ($dh = opendir($dir)){
	$mynf = $dir . "/zwkz_all.txt";
	$mynfile = fopen($mynf, "w") or die("Unable to open file!");
	fwrite($mynfile, "Crash_Key, WZ_Related, WZ_Loc, WZ_Type, Workers\n");
    while (($file = readdir($dh)) !== false){
      echo "filename:" . $file . "<br>";
		if(pathinfo($file, PATHINFO_EXTENSION) == 'dbf'){
			$myf = $dir . '/' . $file;
			$filecontent = file_get_contents($myf);
			$chars = preg_split('//', $filecontent, -1, PREG_SPLIT_NO_EMPTY);
			$ent = 0;
			$sev = false;
			//Code for zwkz
			for ($i = 192; $i < count($chars); $i++) {
				if(!ctype_space($chars[$i])){
					//echo($chars[$i]);
					fwrite($mynfile, $chars[$i]);
					if($sev == false && $ent >= 10 && $chars[$i] == '7'){
						$sev = true;
					} else {
						$ent = ($ent+1)%14;
						if($ent==0){
							//echo "</pre>";
							//echo "<pre>";
							fwrite($mynfile, "\n");
						} else if ($ent > 9){
							//echo " ";
							fwrite($mynfile, ", ");
						}
						$sev = false;
					}
				}
			}
			echo "<br>";
		}
    }
	echo "File Written!";
	fclose($mynfile);
    closedir($dh);
  }
}
?>

<html>

<head>
<title>Car Crash Data</title>

</head>

<body bgcolor="#ECDEC9" text="000000">
<font face="Times New Roman"</font>

</html>
