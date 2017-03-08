<?php
    error_reporting(E_ALL ^ E_DEPRECATED);

    include 'FunctionClass.php';

    $openid     =	$_REQUEST['openid'];

    $timesTamp  =	$_REQUEST['timesTamp'];

    $type       =	$_REQUEST['type'];

    $result = array(
        "info"   => false,
        "res"  =>''
    );

    if (isset($openid)!=true){

        logInfo("openid未设置!");

        $result['res'] = "openid未设置!";

        echo json_encode($result);
    }

    if (isset($timesTamp)!=true){

        logInfo("timesTamp未设置!");

        $result['res'] = "timesTamp未设置!";

        echo json_encode($result);
    }

    if (isset($type)!=true){

        logInfo("type类型未设置!");

        $result['res'] = "type类型未设置!";

        echo json_encode($result);
    }

    if ($type == "image"){

        $sel_Key = array("media_url");

        $typeNum = 1;

    }else if($type=="voice"){

        $sel_Key = array("serverId");

        $typeNum = 2;

    }

    $sel_table      = "wx_media";

    $sel_whereKey   = array("openid","type","timestamp");

    $sel_whereValue = array($openid,$typeNum,$timesTamp);

    $sel_res = sel_sql($sel_Key, $sel_table, $sel_whereKey, $sel_whereValue);

    if ($sel_res!=false) {

        if ($type == "image"){

            $result = array(

                "info" => true,

                "res" => $sel_res[0]['media_url']

            );

        }else if($type=="voice"){

            $result = array(

                "info" => true,

                "res" => $sel_res[0]['serverId']

            );

        }

        logInfo("返回结果 result >>>>>>>".json_encode($result));

        echo json_encode($result);

    }else {

        echo json_encode($result);

    }



?>