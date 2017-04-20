<?php

    header("Access-Control-Allow-Origin: *");

    error_reporting(E_ALL ^ E_DEPRECATED);

    include 'FunctionClass.php';

    $myFile = $_FILES['img']["tmp_name"];

    $city = isset($_POST['city'])?$_POST['city']:"";

    $word = isset($_POST['word'])?$_POST['word']:"";

    $fh = fopen($myFile, 'rb') or die("can't open file");

    $image_file = '';

    while (!feof($fh)) {

        $image_file .= fgets($fh);

    }

    fclose($fh);

    $filename = mt_rand(100000,999999).time();

    $file_path="city/".$city."/";

    if(is_dir($file_path)!=TRUE) mkdir($file_path,0664) ;

    $FileUrl = $file_path.$filename.".jpg";

    $fh = fopen($FileUrl, 'w') or die("can't open file");

    fwrite($fh, $image_file);

    fclose($fh);

    $numKey = array("imageId","imageType","imageCity","word","review","createDate");

    $numValue = array($filename,"jpg",$city,$word,0,date("Y-m-d H:i:s"));

    $table = "mothersDayImage";

    $ins_res = insert_sql($numKey,$numValue,$table);

    if ($ins_res['res']==true){

        $res = array(

            "info" => $filename

        );

    }else {

        $res = array(

            "info" => "error"

        );

    }

    echo json_encode($res);

?>