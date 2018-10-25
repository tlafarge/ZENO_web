<?php

//Options
$debug=FALSE;

//PHP time computation limit
$PHP_TimeLimit = 200;

//ZENO time computation limit
$Zeno_TimeLimit = 195;

//Seconds Before USER data files being removed, set 0 to conserve data
$autoClean_TimeLimit=600;

//variable containing the path to the User temporary data
$UserData = "./UserData";

//variable containing the path to zeno executable
$zeno = "zeno";

//Max ZENO instances running at the same time (0 for unlimited)
$maxZenocount = 2;

?>
