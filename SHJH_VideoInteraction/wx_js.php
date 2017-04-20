<?php 
    //屏蔽错误
    error_reporting(E_ALL ^ E_DEPRECATED);
    
    //引入公共方法
    include 'FunctionClass.php';
    
    //接收参数
    $url = $_REQUEST["url"];
    
    //时间戳
    $timestamp = time();
    
    //字符串
    $wxnonceStr = "brandX";
    
    $token = resTT("token",$timestamp,"");
    
    $ticket = resTT("ticket",$timestamp,$token);
    
    //拼接串
    $wxOri = sprintf("jsapi_ticket=%s&noncestr=%s&timestamp=%s&url=%s",$ticket, $wxnonceStr, $timestamp,$url);
    
    //拼接串写入日志
    logInfo($wxOri);
    
    //sha1签名
    $wxSha1 = sha1($wxOri);
    
    //签名写入日志
    logInfo("sha1签名 =".$wxSha1);
    
    //组装
    $resWx = array(
        "timestamp" => $timestamp,
        "nonceStr" => $wxnonceStr,
        "signature" => $wxSha1
    );
    
    //输出
    echo json_encode($resWx);
?>