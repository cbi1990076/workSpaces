<?php
    //屏蔽错误
    error_reporting(E_ALL ^ E_DEPRECATED);

    //引入公共方法
    include 'FunctionClass.php';

    $date = array(
        "info"=>''
    );

    $typeNum = 2;

    $openid = $_REQUEST["openid"];

    $localId = $_REQUEST["localId"];

    $serverId = $_REQUEST["serverId"];

    $timestamp = $_REQUEST["timestamp"];

    $media_Time = date("Y-m-d H:i:s");

    $media_table = "wx_media";

    $media_key = array("openid","localId","serverId","type","timestamp","addtime");

    $media_value = array($openid,$localId,$serverId,$typeNum,$timestamp,$media_Time);

    $ins_res = insert_sql($media_key, $media_value, $media_table);

    if ($ins_res['res']!=false) {

        logInfo("媒体信息插入数据库成功! id = ".$ins_res['id']);

        $date['info'] = true;

        echo json_encode($date);

    }else {

        logInfo("媒体信息插入数据库出错!");

        $date['info'] = false;

        echo json_encode($date);

    }


?>