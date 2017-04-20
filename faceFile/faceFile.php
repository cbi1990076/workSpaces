<?php

    error_reporting(E_ALL ^ E_DEPRECATED);

    include 'FunctionClass.php';

//    header( "Content-type: image/png");

    $api_key    =   $_REQUEST['api_key'];

    $api_secret =   $_REQUEST['api_secret'];

    if ($_FILES["image_file"]["error"] > 0){

        echo false;

    }else{

        $myFile = $_FILES['image_file']["tmp_name"];

        $fh = fopen($myFile, 'rb') or die("can't open file");

//        $ejz = fread($fh,$_FILES['image_file']['size']);

        $image_file = '';

        while (!feof($fh)) {

            $image_file .= fgets($fh);

        }

        fclose($fh);

        $file_path="upload/";

        if(is_dir($file_path)!=TRUE) mkdir($file_path,0664) ;

        $myFile = $file_path.$_FILES['image_file']["name"];

        $fh = fopen($myFile, 'w') or die("can't open file");

        fwrite($fh, $image_file);

        fclose($fh);

        $data = array(

            'api_key' => $api_key,

            'api_secret' => $api_secret,

            'image_url' => "http://www.brandxspace.com/faceFile/".$myFile,

            'return_landmark' => '1',

            'return_attributes' => "gender,age,smiling,glass"

        );

        logInfo(json_encode($data));

        $url = "https://api-cn.faceplusplus.com/facepp/v3/detect";

        $res = curlPost($url,$data);

        echo $res;

    }
?>