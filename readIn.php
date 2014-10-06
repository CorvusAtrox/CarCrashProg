<?php
   $database = "crash_data";
	
   $con = mysqli_connect("localhost","root" ,"") or die(mysqli_error().mysqli_errno());
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
   mysqli_select_db($con, $database);
  
$dir = $_POST["folder"];
if (is_dir($dir)){
  if ($dh = opendir($dir)){
	//$mynf = $dir . "/zwkz_all.txt";
	//$mynfile = fopen($mynf, "w") or die("Unable to open file!");
	//fwrite($mynfile, "Crash_Key, WZ_Related, WZ_Loc, WZ_Type, Workers\n");
    while (($file = readdir($dh)) !== false){
      echo "filename:" . $file . "<br>";
		if(pathinfo($file, PATHINFO_EXTENSION) == 'dbf'){
			$ft = substr($file, 0, 4);
			$myf = $dir . '/' . $file;
			$filecontent = file_get_contents($myf);
			$chars = preg_split('//', $filecontent, -1, PREG_SPLIT_NO_EMPTY);
			$ent = 0;
			$sev = false;
			//Code for zwkz
			$buff=array("","","","","","");
			$ba = 0;
			for ($i = 192; $i < count($chars); $i++) {
				if(!ctype_space($chars[$i])){
					//echo($chars[$i]);
					$buff[$ba] .= $chars[$i];
					//fwrite($mynfile, $chars[$i]);
					if($sev == false && $ent >= 10 && $chars[$i] == '7'){
						$sev = true;
					} else {
						$ent = ($ent+1)%14;
						if($ent==0){
							/*echo($buff[0].' ');
							echo($buff[1].' ');
							echo($buff[2].' ');
							echo($buff[3].' ');
							echo($buff[4].' ');
							echo "</pre>";
							echo "<pre>";*/
							//fwrite($mynfile, "\n");
							$query = "INSERT IGNORE INTO `zwkz`
							(`Crash_Key`, `WZ_Related`, `WZ_Loc`, `WZ_Type`, `Workers`) 
							VALUES ($buff[0],$buff[1],$buff[2],$buff[3],$buff[4])";
							/*$query = "UPDATE `zwkz` SET `WZ_Related`=$buff[1] ,
							SET WZ_Loc=$buff[2] ,
							SET WZ_Loc=$buff[3] ,
							SET Workers=$buff[4] WHERE Crash_Key=$buff[0]";*/
							mysqli_query($con, $query) or die(mysqli_error($con));
							set_time_limit(0);
							$ba = 0;
							for($j = 0; $j < 5;$j++){
								$buff[$j] = "";
							}
						} else if ($ent > 9){
							//echo " ";
							//fwrite($mynfile, ", ");
							$ba++;
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
