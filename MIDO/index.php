<?php

    header("Content-Type: text/html; charset=utf-8");

    error_reporting(E_ALL ^ E_DEPRECATED);

    include 'FunctionClass.php';

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

            $tokenArray = wx_UserToken($code, $state);

            if ($tokenArray==false){

                $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf508733f4f12c592&redirect_uri=http%3a%2f%2fwww.brandxspace.com%2fMIDO%2findex.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";

                echo "<script language=\"javascript\">";

                echo "location.href=\"$url\"";

                echo "</script>";

            }

            $userInfo = wx_UserInfo($tokenArray['openid'], $tokenArray['token']);

            $num = (int)$num+1;

            $numKey = array("openid");

            $numValue = array($userInfo['openid']);

            $table = "wx_openid";

            switch ($num){

                case 1:

                    $oidRes = upd_sql($numKey,$numValue,$table,"","");

                    $saveURL = $num.".jpg";

                    saveImage($userInfo['HeadImgUrl'],$saveURL);

                    resize_image($saveURL,"jpg",640,640);

                    logRemark($numPath,$num);

                    echo "成功参与！";

                    break;

                case 2:

                    $oidRes = sel_countSql($table,$numKey,$numValue);

                    if ($oidRes<1){

                        $saveURL = $num.".jpg";

                        saveImage($userInfo['HeadImgUrl'],$saveURL);

                        resize_image($saveURL,"jpg",640,640);

                        logRemark($numPath,$num);

                        echo "成功参与！";

                    }else{

                        echo "您已参与！";

                    }

                    break;

            }

            exit;

        }

    }

?>