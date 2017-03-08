<?php
    //屏蔽错误
    error_reporting(E_ALL ^ E_DEPRECATED);
    
    //引入公共方法
    include 'FunctionClass.php';

    $date = array(
        "info"  =>false,
        "res"   =>''
    );

    $typeNum = 1;

    $openid = $_REQUEST["openid"];

	$serverId = $_REQUEST["serverId"];

    $timestamp = $_REQUEST["timestamp"];
    
    $media_Time = date("Y-m-d H:i:s");
    
    $token = resTT("token", $timestamp, "");
    
    if ($token!=false) {
        
        $url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=".$token."&media_id=".$serverId;
        
        $mediaInfo = wx_downloadMedia($url);
        
        $fileName = mt_rand(100000, 999999);

        $fileName = $fileName.".jpg";

        wx_saveMedia($fileName, $mediaInfo['body']);
        
        $media_url = $fileName;

        $media_table = "wx_media";

        $media_key = array("openid","serverId","type","timestamp","media_url","addtime");

        $media_value = array($openid,$serverId,$typeNum,$timestamp,$media_url,$media_Time);

        $ins_res = insert_sql($media_key, $media_value, $media_table);

        if ($ins_res['res']!=false) {

            logInfo("媒体信息插入数据库成功! id = ".$ins_res['id']);

            $date['info'] = true;

            $date['res'] = "媒体信息插入数据库成功!";

            echo json_encode($date);

        }else {

            logInfo("媒体信息插入数据库出错!");

            $date['res'] = "媒体信息插入数据库出错!";

            echo json_encode($date);

        }

    }else {
        
        logInfo("获取token失败!");

        $date['res'] = "获取token失败!";

        echo json_encode($date);
        
    }
?>