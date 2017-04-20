<?php
    //屏蔽错误
    error_reporting(E_ALL ^ E_DEPRECATED);
    
    //引入公共方法
    include 'FunctionClass.php';
    
    //接收参数
    $code=$_REQUEST['code'];
    
    $state=$_REQUEST['state'];
    
    //判断参数是否存在
    if (isset($code)==true) {
        $code_time = time();
        
        $code_numKey = array("openid","code","state","code_time");
        
        $code_numValue = array("",$code,$state,$code_time);
        
        $code_table = "wxrz_code";
        
        $code_res = insert_sql($code_numKey, $code_numValue, $code_table);
        
        if ($code_res['res']!=false){
            
            //插入数据库成功 写入日志
            logInfo("插入数据库成功 - code = ".$code);

            //获取token链接
            $token_Url = sprintf("https://api.weixin.qq.com/sns/oauth2/access_token?appid=%s&secret=%s&code=%s&grant_type=authorization_code",AppID,AppSecret,$code);
            
            //将链接放入字符串
            $token_Urls = file_get_contents($token_Url);
            
            //返回值记入日志
            logInfo($token_Urls);
            
            //json转译
            $tokenUrl = json_decode($token_Urls, true);
            
            //提取参数
            $access_token = $tokenUrl['access_token'];
            
            $refresh_token = $tokenUrl['refresh_token'];
            
            $openid = $tokenUrl['openid'];
            
            $scope = $tokenUrl['scope'];
            
            $token_time = time();
            
            //设置更新code openid参数
            $codeOid_numKey = array("openid");
            
            $codeOid_numValue = array($openid);
            
            $codeOid_table = "wxrz_code";
            
            $codeOid_whereKey = array("id");
            
            $codeOid_whereValue = array($code_res['id']);
            
            $code_ress = upd_sql($codeOid_numKey, $codeOid_numValue, $codeOid_table, $codeOid_whereKey, $codeOid_whereValue);
            
            if ($code_ress!=false){
                
                //更新数据库成功 写入日志
                logInfo("更新数据库成功 - code_openid = ".$openid);
                
            }else {
                
                //更新数据库成功 写入日志
                logInfo("更新数据库失败 - code_openid = ".$openid);
                
            }
            
            //设置插入token数据参数
            $token_numKey = array("openid","access_token","refresh_token","scope","token_time");
            
            $token_numValue = array($openid,$access_token,$refresh_token,$scope,$token_time);
            
            $token_table = "wxrz_token";
            
            //拼接更新参数
            $token_res = insert_sql($token_numKey, $token_numValue, $token_table);
            
            if ($token_res['res']!=false) {
                
                //插入数据库成功 写入日志
                logInfo("插入数据库成功 - token = ".$access_token);
                
                //请求用户数据
                $userInfo_Url = sprintf("https://api.weixin.qq.com/sns/userinfo?access_token=%s&openid=%s&lang=zh_CN",$access_token,$openid);
                
                //将链接放入字符串
                $user_Url = file_get_contents($userInfo_Url);
                
                //返回值记入日志
                logInfo($user_Url);
                
                //json转译
                $userInfo = json_decode($user_Url, true);
                
                //提取参数
                $userOpenID = $userInfo['openid'];
                
                $userNickName = $userInfo['nickname'];
                
                $userSex = $userInfo['sex'];
                
                $userProvince = $userInfo['province'];
                
                $userCity = $userInfo['city'];
                
                $userCountry = $userInfo['country'];
                
                $userHeadImgUrl = $userInfo['headimgurl'];
                
                $selOid_numKey = array("openid");
                
                $selOid_numValue = array($userOpenID);
                
                $user_table = "wx_userinfo";
                
                $userNumber = sel_countSql($user_table, $selOid_numKey, $selOid_numValue);
                
                $userInfo_Time = date("Y-m-d H:i:s");
                
                if ($userNumber>0) {
                    
                    $user_numKey = array("nickname","sex","country","city","province","headimgurl","update_time");
                    
                    $user_numValue = array($userNickName,$userSex,$userCountry,$userCity,$userProvince,$userHeadImgUrl,$userInfo_Time);
                    
                    $user_res = upd_sql($user_numKey, $user_numValue, $user_table, $selOid_numKey, $selOid_numValue);
                    
                }else {
                    
                    $user_numKey = array("openid","nickname","sex","country","city","province","headimgurl","add_time");
                    
                    $user_numValue = array($userOpenID,$userNickName,$userSex,$userCountry,$userCity,$userProvince,$userHeadImgUrl,$userInfo_Time);
                    
                    $user_res = insert_sql($user_numKey, $user_numValue, $user_table);
                    
                }
                
                if ($user_res['res']!=false){

                    //插入数据库成功 写入日志
                    logInfo("用户信息插入数据库成功 = ".$user_res['id']);
                    
                    $userInfoResult = array(
                        "info" => "suessc",
                        "openid" => $userOpenID
                    );
                    
                }else {
                    
                    //插入数据库出错 写入日志
                    logInfo("用户信息插入数据库出错");
                    
                    $userInfoResult = array(
                        "info" => "error",
                        "openid" => $userOpenID
                    );
                    
                }
                
                    return json_encode($userInfoResult);
                
            }else {
                
                //插入数据库出错 写入日志
                logInfo("插入数据库出错 - token = ".$access_token);
                
            }
            
        }else {
            
            //插入数据库出错 写入日志
            logInfo("插入数据库出错 - code = ".$code);
            
        }
        
    }else {
        
        //用户未授权 写入日志
        logInfo("code为空!用户未授权!");
        
    }
?>