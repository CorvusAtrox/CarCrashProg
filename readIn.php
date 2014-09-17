<?php
$dir = $_POST["folder"];
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
      echo "filename:" . $file . "<br>";
		if(pathinfo($file, PATHINFO_EXTENSION) == 'dbf'){
			$myf = $dir . '/' . $file;
			$myfile = fopen($myf, "r") or die("Unable to open file!");
			echo fread($myfile,filesize($myf));
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

