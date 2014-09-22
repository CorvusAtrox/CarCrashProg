<?php
$dir = $_POST["folder"];
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
      echo "filename:" . $file . "<br>";
		if(pathinfo($file, PATHINFO_EXTENSION) == 'dbf'){
			$myf = $dir . '/' . $file;
			$myfile = fopen($myf, "r") or die("Unable to open file!");
			//echo fread($myfile,filesize($myf));
			$filecontent = file_get_contents($myf);
			$chars = preg_split('//', $filecontent, -1, PREG_SPLIT_NO_EMPTY);
			$ent = 0;
			$sev = false;
			//Code for zwkz
			for ($i = 192; $i < count($chars); $i++) {
				if(!ctype_space($chars[$i])){
					echo($chars[$i]);
					if($sev == false && $ent >= 10 && $chars[$i] == '7'){
						$sev = true;
					} else {
						$ent = ($ent+1)%14;
						if($ent==0){
							echo "</pre>";
							echo "<pre>";
						} else if ($ent > 9){
							echo " ";
						}
						$sev = false;
					}
				}
			}
			fclose($myfile);
			echo "<br>";
		} else {
			echo pathinfo($file, PATHINFO_EXTENSION);
		}
    }
    closedir($dh);
  }
}
?>

