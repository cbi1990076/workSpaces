<?php

    header("Access-Control-Allow-Origin: *");

    error_reporting(E_ALL ^ E_DEPRECATED);

    include 'FunctionClass.php';

    $city = isset($_POST['city'])?$_POST['city']:"beijing";

    $num = "";

    $table = "mothersdayimage";

    $whereKey = array("imageCity","review");

    $whereValue = array($city,0);

    $orderBy = "id";

    $soft = "asc";

    $limit[0] = 0;

    $limit[1] = 1;

    $selRes = sel_sql($num,$table,$whereKey,$whereValue,$orderBy,$soft,$limit);

    if ($selRes!=false){

        $res = array(

            "imageUrl" => "http://www.brandxspace.com/mothersDay/city/".$selRes[0]['imageCity']."/".$selRes[0]['imageId'].".".$selRes[0]['imageType'],

            "imageId" => $selRes[0]['imageId']

        );

    }else{

        $res = array(

            "imageUrl" => "",

            "imageId" => ""

        );

    }

    echo json_encode($res);

?>