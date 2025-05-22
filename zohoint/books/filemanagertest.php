<?php

if (file_exists("test.bat")){
	echo "file already exist, deleting it";
	unlink("test.bat");
} else {
$file = fopen("test.bat","w");
echo fwrite($file,"Hello World. Testing!");
fclose($file);
}

?>