<?php

    error_reporting(E_ALL ^ E_DEPRECATED);

    include 'FunctionClass.php';

    $type = $_REQUEST['type'];

    logInfo("type= ".$type);

    if($type==0){

        $numPath = "Num.txt";

        $num = file_get_contents($numPath);

        logRemark($numPath,0);

    }

    $typePath = "Type.txt";

    logRemark($typePath,$type);

    ?>