<?php

$datat = "Basic Life Support (BLS) Blended Learning – Provider";

$arr = explode("\n", $datat);

$realname = $arr[0]." ".$arr[1]."(".$arr[3].")" ;
echo $datat;
echo "<br>". $realname;

?>