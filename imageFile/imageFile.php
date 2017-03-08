<?php

    include 'FunctionClass.php';

    $myFile = $_FILES["post"]["tmp_name"];

    $content = '';

    $fh = fopen($myFile, 'r') or die("can't open file");

    while (!feof($fh)) {

        $content .= fgets($fh);

    }

    fclose($fh);

    $file_path="upload/";

    if(is_dir($file_path)!=TRUE) mkdir($file_path,0664);

    $myFileName = mt_rand(100000,999999).time();

    $myFile = $file_path.$myFileName.".png";

    $numKey = array("imageName");

    $numValue = array($myFileName);

    $table = "te_table";

    $table2 = "te_table2";

    $WhereKey = array("id");

    $WhereValue = array('1');

    $ins_Res = insert_sql($numKey,$numValue,$table);

    $upd_Res = upd_sql($numKey,$numValue,$table2,$WhereKey,$WhereValue);

    $fh = fopen($myFile, 'w') or die("can't open file");

    $stringData = $content;

    fwrite($fh, $stringData);

    fclose($fh);

    logRemark("interFace.txt","0");

    $clk_path = "clickNumber.txt";

    $clkNum = file_get_contents($clk_path);

    $num = (int)$clkNum+1;

    logRemark("clickNumber.txt",$num);

    echo "OK";

?>