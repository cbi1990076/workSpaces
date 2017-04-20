<?php
/*
 * 登录你的微信平台，点击“公众号设置”。
 * 点击“功能设置”，然后点击“设置”。
 * 设置JS接口安全域名。这里填写的是一级域名，不带www和http。最多可以设置三个域名。设置完后点击确定。
 * 在开发者中心中获取你的AppID和AppSecret，接下来在获取令牌时，需要这两个信息。
 * 获取令牌
 * 获取jsapi的ticket。jsapi_ticket是公众号用于调用微信JS接口的临时票据。
 * 正常情况下，jsapi_ticket的有效期为7200秒，通过access_token来获取。
 * 签名，将jsapi_ticket、noncestr、timestamp、分享的url按字母顺序连接起来，进行sha1签名。
 * noncestr是你设置的任意字符串。
 * timestamp为时间戳。
 * 字符串最终形态 jsapi_ticket=XX&noncestr=XX&timestamp=XX&url=XX
*/

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
    
    //微信JS_Code
    $wxticket = wx_get_jsapi_ticket($timestamp);
    
    //拼接串
    $wxOri = sprintf("jsapi_ticket=%s&noncestr=%s&timestamp=%s&url=%s",$wxticket, $wxnonceStr, $timestamp,$url);
    
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
    
    //这里是注释
    function wx_get_jsapi_ticket($time){
    
        //开发者Id
        $appid = "wxf508733f4f12c592";
    
        //开发者钥匙
        $AppSecret = "d021083c9daba4eb1cd80ab2559dbf7c";
    
        //声明参数
        $ticket = "";
        $token_num = array("access_token","wx_time");
        $token_table = "wx_js";
        $token_whereKey = "";
        $token_whereValue = "";
    
        //查询token
        $token_res = sel_sql($token_num, $token_table, $token_whereKey, $token_whereValue);
        
        //判断
        if ($token_res['access_token']!=""&&count($token_res['access_token'])>0){

            //结果集有值
            if ($time-$token_res['wx_time']>7000){
    
                //双更
                $result = wx_get_double($appid,$AppSecret);
    
                return $result;
    
            }else {
    
                $token = $token_res['access_token'];
    
            }
    
        }else {
    
            //结果集没值
            //获取token -- 参数:access_token
            $result = wx_get_token("access_token","",$time,$appid,$AppSecret);
    
            //判断返回值
            if ($result['res']==true){
    
                //成功获取token值
                $token = $result['code'];
    
            }else if ($result['res']==false){
    
                //出错写入日志
                logInfo("wx_get_token方法token查询出错");
    
                //返回错误
                return false;
    
            }
        }
         
        //声明参数
        $ticket_num = array("jsapi_ticket");
        $ticket_table = "wx_js";
        $ticket_whereKey = "";
        $ticket_whereValue = "";
    
        //查询ticket
        $ticket_res = sel_sql($ticket_num, $ticket_table, $ticket_whereKey, $ticket_whereValue);
    
        //判断查询结果
        if ($ticket_res['jsapi_ticket']!="" && count($ticket_res['jsapi_ticket'])>0){
    
            //结果集有值
            $ticket = $ticket_res['jsapi_ticket'];
    
        }else {
            
            //结果集没值
            //进入ticket查询方法 -- 参数:jsapi_ticket,token
            $result = wx_get_token("jsapi_ticket",$token,"","","");
            
            //判断返回值
            if ($result['res']==true){
    
                //成功获取ticket值
                $ticket = $result['code'];
    
            }else if ($result['res']==false){
    
                //出错写入日志
                logInfo("wx_get_token方法ticket查询出错");
    
                //返回错误
                return false;
    
            }
    
        }
    
        //返回值
        return $ticket;
    
    }
    
    //获取令牌
    function wx_get_token($wx_Type,$info,$time,$appid,$AppSecret) {
        
        //判断方法参数
        if ($wx_Type=="access_token"){
            
            //链接
            $res = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$AppSecret);
            
            //获取微信token写入日志
            logInfo("token原始串 =".$res);
            
            //json转换
            $res = json_decode($res, true);
            
            //赋值
            $token = $res['access_token'];
            
            //拼装参数
            $token_NumKey = array("access_token","wx_time");
            $token_NumValue = array($token,$time);
            $token_Table = "wx_js";
            $token_WhereKey = array("id");
            $token_WhereValue = array("1");
            
            //更新token值
            $result['res'] = upd_sql($token_NumKey,$token_NumValue,$token_Table,$token_WhereKey,$token_WhereValue);
            
            if ($result['res']!=false){
                
                //更新数据库成功 写入日志
                logInfo("更新数据库成功 - token = ".$token);
                
            }else {
                
                //更新数据库出错 写入日志
                logInfo("更新数据库出错 - token = ".$token);
                
            }
            
            //结果集-Code
            $result['code'] = $token;
            
        }else if ($wx_Type=="jsapi_ticket"){
            
            //链接
            $url2 = sprintf("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=%s&type=jsapi",$info);
            
            //将链接放入字符串
            $res = file_get_contents($url2);
            
            $res = json_decode($res, true);
    
            $ticket = $res['ticket'];
            
            //拼装参数
            $ticket_NumKey = array("jsapi_ticket");
            $ticket_NumValue = array($ticket);
            $ticket_Table = "wx_js";
            $ticket_WhereKey = array("id");
            $ticket_WhereValue = array("1");
            
            //更新ticket值
            $result['res'] = upd_sql($ticket_NumKey, $ticket_NumValue, $ticket_Table, $ticket_WhereKey, $ticket_WhereValue);
    
            if ($result['res']!=false){
                
                //更新数据库成功 写入日志
                logInfo("更新数据库成功 - ticket = ".$ticket);
                
            }else {
                
                //更新数据库出错 写入日志
                logInfo("更新数据库出错 - ticket = ".$ticket);
                
            }
            
            //结果集-Code
            $result['code'] = $ticket;
            
        }else {
            logInfo("方法参数出错 =".$wx_Type);
        }
        
        return $result;
    }
    
    //获取令牌
    function wx_get_double($appid,$AppSecret) {
    
        //链接
        $res = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$AppSecret);
    
        //获取微信token写入日志
        logInfo("token原始串 =".$res);
    
        //json转换
        $res = json_decode($res, true);
    
        //赋值
        $token = $res['access_token'];
    
        //拼装参数
        $token_NumKey = array("access_token");
        $token_NumValue = array($token);
        $token_Table = "wx_js";
        $token_WhereKey = array("id");
        $token_WhereValue = array("1");
    
        //更新token值
        $token_res = upd_sql($token_NumKey,$token_NumValue,$token_Table,$token_WhereKey,$token_WhereValue);
    
        if ($token_res!=false){
    
            //更新数据库成功 写入日志
            logInfo("更新数据库成功 - token = ".$token);
    
        }else {
    
            //更新数据库出错 写入日志
            logInfo("更新数据库出错 - token = ".$token);
    
        }
    
        //链接
        $url2 = sprintf("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=%s&type=jsapi",$token);
    
        //将链接放入字符串
        $res = file_get_contents($url2);
    
        $res = json_decode($res, true);
    
        $ticket = $res['ticket'];
    
        //拼装参数
        $ticket_NumKey = array("jsapi_ticket");
        $ticket_NumValue = array($ticket);
        $ticket_Table = "wx_js";
        $ticket_WhereKey = array("id");
        $ticket_WhereValue = array("1");
    
        //更新ticket值
        $ticket_res = upd_sql($ticket_NumKey, $ticket_NumValue, $ticket_Table, $ticket_WhereKey, $ticket_WhereValue);
    
        if ($ticket_res!=false){
    
            //更新数据库成功 写入日志
            logInfo("更新数据库成功 - ticket = ".$ticket);
    
        }else {
    
            //更新数据库出错 写入日志
            logInfo("更新数据库出错 - ticket = ".$ticket);
    
        }
    
        //结果集-Code
        $result = $ticket;
    
        return $result;
    }
    
?>