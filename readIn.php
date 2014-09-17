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
			for ($i = 0; $i < count($chars); $i++) {
				echo "<pre>";
				//echo strcmp($chars[$i],'Á');
				echo($chars[$i]);
				echo "</pre>";
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

