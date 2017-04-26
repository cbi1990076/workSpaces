<?php

header("Content-Type: text/html; charset=utf-8");

error_reporting(E_ALL ^ E_DEPRECATED);

include 'FunctionClass.php';

$res = "灵感迷宫为您敞开<br>动动双脚开始闯关";

//判断是否开始 0未开始 1已开始
$typePath = "Type.txt";

$typeNum = file_get_contents($typePath);

if ($typeNum == 0){

    //判断人数
    $numPath = "Num.txt";

    $num = file_get_contents($numPath);

    if ($num<2){

        $code = isset($_REQUEST['code'])?$_REQUEST['code']:"";

        if ($code == ""){

            urlCode();

        }

        $state=$_REQUEST['state'];

        $codeKey = array("code");

        $codeValue = array($code);

        $whereKey = array("id");

        $whereValue = array(1);

        $codeTable = "midoCode_cz";

        switch ($num){

            case 0:

                $codeRes = upd_sql($codeKey,$codeValue,$codeTable,$whereKey,$whereValue);

                $tokenArray = tokenArray($code, $state,$num,$numPath);

                break;

            case 1:

                $codeRes = sel_countSql($codeTable,$codeKey,$codeValue);

                if ($codeRes<1){

                    $tokenArray = tokenArray($code, $state,$num,$numPath);

                }else{

                    urlCode();

                }

                break;

        }

    }else{

        $res = "此轮游戏人数已满<br><p style='font-size: 58px;'>请于下轮开始前刷新页面</p>";

    }

}else{

    $res = "此轮游戏已经开始<br><p style='font-size: 58px'>请于下轮开始前刷新页面</p>";

}


function tokenArray($code, $state,$num,$numPath){

    $tokenArray = wx_UserToken($code, $state);

    if ($tokenArray == false){

        urlCode();

    }

    if(isset($tokenArray['openid'])==true && $tokenArray['openid']!=""){

        $openidKey = array("openid");

        $openidValue = array($tokenArray['openid']);

        $whereKey = array("id");

        $whereValue = array(1);

        $openidTable = "midoOpenid_cz";

        if ($num == 0){

            $oidRes = upd_sql($openidKey,$openidValue,$openidTable,$whereKey,$whereValue);

            $num = (int)$num+1;

            $userInfo = wx_UserInfo($tokenArray['openid'], $tokenArray['token']);

            $saveURL = $num.".jpg";

            saveImage($userInfo['HeadImgUrl'],$saveURL);

            resize_image($saveURL,"jpg",640,640);

            logRemark($numPath,$num);

        }else if ($num == 1){

            $oidRes = sel_countSql($openidTable,$openidKey,$openidValue);

            if ($oidRes<1){

                $num = (int)$num+1;

                $userInfo = wx_UserInfo($tokenArray['openid'], $tokenArray['token']);

                $saveURL = $num.".jpg";

                saveImage($userInfo['HeadImgUrl'],$saveURL);

                resize_image($saveURL,"jpg",640,640);

                logRemark($numPath,$num);

            }

        }

        return "OK";

    }else{

        urlCode();

    }

}

function urlCode(){

    $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf508733f4f12c592&redirect_uri=http%3a%2f%2fwww.brandxspace.com%2fMIDO_ChangZhou%2findex.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";

    echo "<script language=\"javascript\">";

    echo "location.href=\"$url\"";

    echo "</script>";

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>MIDO</title>

    <style>

        body,html{height: 100%;width: 100%;margin: 0;padding: 0;overflow: hidden;}

        img{width: 100%;height: 100%;position: absolute;z-index: 0;}

        div{font-size: 65px;font-family: "黑体";font-weight: bold;color: rgb(239,131,0);position: relative;z-index: 90;margin-top: 71%;letter-spacing:12px;width: 100%;text-align: center;}

    </style>

</head>

<body>

<img src="bg.jpg">

<div>

    <?php echo $res?>

</div>

</body>

</html>