<?php

    header("Content-Type: text/html; charset=utf-8");

    error_reporting(E_ALL ^ E_DEPRECATED);

    include 'FunctionClass.php';

    session_start();

    //判断是否开始 0未开始 1已开始
    $typePath = "Type.txt";

    $typeNum = file_get_contents($typePath);

    if ($typeNum == 0){

        //判断人数
        $numPath = "Num.txt";

        $num = file_get_contents($numPath);

        if ($num<2){

            $code=$_REQUEST['code'];

            $state=$_REQUEST['state'];

            $num = (int)$num+1;

            switch ($num){

                case 1:

                    $_SESSION['code'] = $code;

                    $tokenArray = wx_UserToken($code, $state);

                    if (json_encode($tokenArray)=="false"){

                        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf508733f4f12c592&redirect_uri=http%3a%2f%2fwww.brandxspace.com%2fMIDO%2findex.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";

                        echo "<script language=\"javascript\">";

                        echo "location.href=\"$url\"";

                        echo "</script>";

                    }

                    if($tokenArray['openid']!="" && $tokenArray['openid']!=null && $tokenArray['openid']!=false){

                        $userInfo = wx_UserInfo($tokenArray['openid'], $tokenArray['token']);

                        $numKey = array("openid");

                        $numValue = array($userInfo['openid']);

                        $whereKey = array("id");

                        $whereValue = array(1);

                        $table = "wx_openid";

                        $oidRes = upd_sql($numKey,$numValue,$table,$whereKey,$whereValue);

                        $saveURL = $num.".jpg";

                        saveImage($userInfo['HeadImgUrl'],$saveURL);

                        resize_image($saveURL,"jpg",640,640);

                        logRemark($numPath,$num);

                        echo "成功参与！";

                    }else{

                        echo "请勿重复刷新！";

                    }

                    break;

                case 2:

                    if ($_SESSION['code'] != $code){

                        $tokenArray = wx_UserToken($code, $state);

                        if (json_encode($tokenArray)=="false"){

                            $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf508733f4f12c592&redirect_uri=http%3a%2f%2fwww.brandxspace.com%2fMIDO%2findex.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";

                            echo "<script language=\"javascript\">";

                            echo "location.href=\"$url\"";

                            echo "</script>";

                        }

                        $userInfo = wx_UserInfo($tokenArray['openid'], $tokenArray['token']);

                        $numKey = array("openid");

                        $numValue = array($userInfo['openid']);

                        $whereKey = array("id");

                        $whereValue = array(1);

                        $table = "wx_openid";

                        $oidRes = sel_countSql($table,$numKey,$numValue,$whereKey,$whereValue);

                        $_SESSION['code'] = $code;

                        if ($oidRes<1){

                            $saveURL = $num.".jpg";

                            saveImage($userInfo['HeadImgUrl'],$saveURL);

                            resize_image($saveURL,"jpg",640,640);

                            logRemark($numPath,$num);

                            echo "成功参与！";

                        }else{

                            echo "您已参与！";

                        }

                    }else{

                        $_SESSION['code'] = $code;

                        echo "您已参与游戏！";

                    }

                    break;

            }

            exit;

        }

    }

?>