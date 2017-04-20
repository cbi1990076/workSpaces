<?php

    header("Access-Control-Allow-Origin: *");

    error_reporting(E_ALL ^ E_DEPRECATED);

    include 'FunctionClass.php';

    $reviews = isset($_POST['review'])?$_POST['review']:false;

    $imageId = isset($_REQUEST['imgId'])?$_REQUEST['imgId']:false;

    $city = isset($_REQUEST['city'])?$_REQUEST['city']:false;

//    if ($review !=false && $imageId !=false&& $city !=false){
//
//        $numKey = array("review");
//
//        $numValue = array($review);
//
//        $whereKey = array("imageId");
//
//        $whereValue = array($imageId);
//
//        $table = "mothersdayimage";
//
//        $updRes = upd_sql($numKey,$numValue,$table,$whereKey,$whereValue);
//
//        if ($updRes==true){
//
//            if ($review == 1){
//
//                $myFile = "city/".$city."/".$imageId.".jpg";
//
//                $fh = fopen($myFile, 'rb') or die("can't open file");
//
//                $image_file = '';
//
//                while (!feof($fh)) {
//
//                    $image_file .= fgets($fh);
//
//                }
//
//                fclose($fh);
//
//                $num = array("id");
//
//                $table = "reviewImage";
//
//                $whereKey = "";
//
//                $whereValue = "";
//
//                $orderBy = "";
//
//                $soft = "";
//
//                $limit = "";
//
//                $selRes = sel_sql($num,$table,$whereKey,$whereValue,$orderBy,$soft,$limit);
//
//                $FileUrl = "unity3dCity/".$city."/".$selRes[0].".jpg";
//
//                $fh = fopen($FileUrl, 'w') or die("can't open file");
//
//                fwrite($fh, $image_file);
//
//                fclose($fh);
//
//                if ($number<50){
//
//                    $number = (int)$selRes[0]+1;
//
//                }else{
//
//                    $number = 1;
//
//                }
//
//
//                $value = array($number);
//
//                $updateRes = upd_sql($num,$value,$table,"","");
//
//            }
//
//            echo json_encode(array("info" => 1));
//
//        }else{
//
//            echo json_encode(array("info" => 0));
//
//        }
//
//    }else{
//
//        echo json_encode(array("info" => 0));
//
//    }
echo json_encode(array("reviews" => $reviews,"imgId" => $imageId,"city" => $city));



?>