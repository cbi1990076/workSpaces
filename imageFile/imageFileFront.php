<?php
    error_reporting(E_ALL ^ E_DEPRECATED);

    include 'FunctionClass.php';

    $typeNum = $_REQUEST['pageNum'];

    $times = time();

    $res = array(

        "res"=> false,

        "imageKey" => "",

        "imagePath" => ""

    );

    $op_NumKey = array("operation","time");

    $op_NumValue = array();

    $op_WhereKey = array("id");

    $op_WhereValue = array('1');

    $op_table = "te_userOperation";

    $str = sel_sql($op_NumKey,$op_table,$op_WhereKey,$op_WhereValue);

    if($str[0]['operation']==1){

        if (($times - $str[0]['time'])>=10){

            $op_NumValue = array('0',"");

            upd_sql($op_NumKey,$op_NumValue,$op_table,$op_WhereKey,$op_WhereValue);

            $str[0]['operation']=0;

        }

    }

    switch ($typeNum){

        case 0:

            if($str[0]['operation']==0){

                $res['res'] = true;

                $op_NumValue = array('1',$times);

                upd_sql($op_NumKey,$op_NumValue,$op_table,$op_WhereKey,$op_WhereValue);

                logRemark("interFace.txt","1");

            }

            echo json_encode($res);

            break;

        case 1:

            logRemark("interFace.txt",$typeNum);

            $res['res'] = true;

            echo json_encode($res);

            break;

        case 2:

            logRemark("interFace.txt",$typeNum);

            $res['res'] = true;

            echo json_encode($res);

            break;

        case 3:

            logRemark("interFace.txt",$typeNum);

            $res['res'] = true;

            echo json_encode($res);

            break;

        case 5:

            logRemark("interFace.txt",$typeNum);

            $res['res'] = true;

            echo json_encode($res);

            break;

        case 6:

            $te_NumKey = array("imageName");

            $te_Table = "te_table2";

            $te_whereKey = array("id");

            $te_whereValue = array('1');

            $selRes = sel_sql($te_NumKey,$te_Table,$te_whereKey,$te_whereValue);

            if($selRes[0]['imageName']!=""&&$selRes[0]['imageName']!=null){

                $te_NumValue = array("");

                $updRes = upd_sql($te_NumKey,$te_NumValue,$te_Table,$te_whereKey,$te_whereValue);

                $op_NumValue = array('0',"");

                upd_sql($op_NumKey,$op_NumValue,$op_table,$op_WhereKey,$op_WhereValue);

                $source = imagecreatefrompng("upload/".$selRes[0]['imageName'].".png");

                $rotate = imagerotate($source, 270, 0);

                imagejpeg($rotate,"upload/".$selRes[0]['imageName'].".png");

                $res['imageKey'] = $selRes[0]['imageName'];

                $res['imagePath'] = "/TE/upload/".$selRes[0]['imageName'].".png";

            }

            $res['res'] = true;

            logInfo(json_encode($res));

            echo json_encode($res);

            break;

        case 7:

            $imageKey = $_REQUEST['imageKey'];

            if(isset($imageKey)!=true){

                echo json_encode($res);

                break;

            }

            $del_Table = "te_table";

            $delWhereKey = array("imageName");

            $delWhereValue = array($imageKey);

            $del_res = del_sql($del_Table,$delWhereKey,$delWhereValue);

            $op_NumValue = array('0',"");

            upd_sql($op_NumKey,$op_NumValue,$op_table,$op_WhereKey,$op_WhereValue);

            logRemark("interFace.txt",1);

            if($del_res==true){

                $res['res'] = true;

                echo json_encode($res);

            }else{

                echo json_encode($res);

            }

            break;

        case 8:

            $imageKey = $_REQUEST['imageKey'];

            if(isset($imageKey)!=true){

                echo json_encode($res);

                break;

            }

            $res['res'] = true;

            $res['imageKey'] = $imageKey;

            $res['imagePath'] = "http://www.brandxspace.com/TE/upload/".$imageKey.".png";

            $clk_path = "shareNumber.txt";

            $clkNum = file_get_contents($clk_path);

            $num = (int)$clkNum+1;

            logRemark("shareNumber.txt",$num);

            echo json_encode($res);

            break;

    }

?>