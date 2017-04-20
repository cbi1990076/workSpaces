<?php
    //屏蔽错误
    error_reporting(E_ALL ^ E_DEPRECATED);
    
    //引入公共方法
    include 'FunctionClass.php';
    
    $dateT = array(
        "info"=>true
    );
    
    $dateT = json_encode($dateT);
    
    $dateF = array(
        "info"=>false
    );
    
    $dateF = json_encode($dateF);
    
    $openid = $_REQUEST["openid"];
    
    $type = $_REQUEST["type"];
    
    $mediaID = $_REQUEST["media_id"];
    
    $timestamp = time();
    
    $media_Time = date("Y-m-d H:i:s");
    
    $token = resTT("token", $timestamp, "");
    
    if ($token!=false) {
        
        $url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=".$token."&media_id=".$mediaID;
        
        $mediaInfo = wx_downloadMedia($url);
        
        $fileName = mt_rand(100000, 999999);
        
        if ($type == "image"){
            
            $fileName = $fileName.".jpg";
            
            $typeNum = 1;
            
        }else if($type=="voice"){
            
            $fileName = $fileName.".mp3";
            
            $typeNum = 2;
            
        }
        
        wx_saveMedia($fileName, $mediaInfo['body']);
        
        $media_url = $fileName;
        
        $media_sel_key = array('openid','type');
        
        $media_sel_value = array($openid,$typeNum);
        
        $media_table = "wx_media";
        
        $sel_res = sel_countSql($media_table, $media_sel_key, $media_sel_value);
        
        logInfo("注意这里啦！ ".$sel_res);
        
        
        if ($sel_res>0){
            
            $media_key = array("media_url","updtime");
            
            $media_value = array($media_url,$media_Time);
            
            $upd_res = upd_sql($media_key, $media_value, $media_table, $media_sel_key, $media_sel_value);
            
            if ($upd_res!=false) {
                
                logInfo("媒体信息更新数据库成功!");
                
                echo $dateT;
                
            }else {
                
                logInfo("媒体信息更新数据库出错!");
                
                echo $dateF;
                
            }
            
        }else {
            
            $media_key = array("openid","type","media_url","addtime");
            
            $media_value = array($openid,$typeNum,$media_url,$media_Time);
            
            $ins_res = insert_sql($media_key, $media_value, $media_table);
            
            if ($ins_res['res']!=false) {
                
                logInfo("媒体信息插入数据库成功! id = ".$ins_res['id']);
                
                echo $dateT;
                
            }else {
                
                logInfo("媒体信息插入数据库出错!");
                
                echo $dateF;
                
            }
            
        }
        
        
        
    }else {
        
        logInfo("获取token失败!");
        
        echo $dateF;
        
    }
?>