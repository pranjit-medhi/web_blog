<?php
date_default_timezone_get("Asia/Kolkata");
$CurrentTime=time();
//$DateTime = strftime("%Y-%m-%d  %H:%M:%S", $CurrentTime);
$DateTime = strftime("%d-%B-%Y  %H:%M:%S", $CurrentTime);

echo "$DateTime";
?>
