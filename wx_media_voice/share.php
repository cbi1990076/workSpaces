<?php
    
    error_reporting(E_ALL ^ E_DEPRECATED);

    $openid = $_REQUEST['openId'];

    $timesTamp = $_REQUEST['timestamp'];

    if (isset($openid)!=true){
        //非正常访问途径
        $openid = "";
    }

    if (isset($timesTamp)!=true){
        //非正常访问途径
        $timesTamp = "";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>元宵·温情</title>
</head>
<link rel="stylesheet" href="lib/animate.min.css">
<link rel="stylesheet" href="lib/inedx.css">
<script src="lib/jquery-2.2.0.min.js"></script>
<script src="lib/prefixfree.min.js"></script>
<script src="lib/rem.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="lib/shareWX.js"></script>
<script src="lib/index.js"></script>
<body>
<div class="shareTop">
    <img src="images/box.png" alt="" class="boxShadow">
    <!--上传后修改路径-->
    <div id="pic">
        <img src="images/demo.jpg" alt="" id="showPic">
    </div>
</div>
<div>
    <img src="images/ji.png" alt="" class="chichen">
</div>
<div class="shareBottom">
    <div class="fir">
        <img src="images/share_icon.png" alt="" class="shareBtn">
    </div>
    <div>
        <img src="images/playSound.png" alt="" class="startSound">
        <img src="images/stopSound.png" alt="" class="stopSound">
    </div>
    <div>
        <img src="images/make.png" alt="" class="make">
    </div>
</div>
<audio  src="images/bgm.mp3" loop="loop" id="sounds" preload>
    您的浏览器不支持 音频控件。
</audio>
<script>
    document.getElementById('sounds').play();
    document.addEventListener("WeixinJSBridgeReady", function () {
        document.getElementById('sounds').play();
    }, false);
</script>
<img src="images/icon.png" alt="" class="playMusic">

<div id="shareCover">
    <div class="cover"></div>
    <img src="images/share.png" alt="">
</div>
<script type="text/javascript">

	var openid = "<?PHP echo $openid ?>";

    var timesTamps = "<?PHP echo $timesTamp ?>";

	var url  ="http://www.brandxspace.com/wx_media_voice/wx_selectMedia.php";

	var param = {
		"openid": openid,
        "timesTamp": timesTamps,
		"type" : "image"
	};

	postAjax(url,param,function(data){

		if(data.info==true){

            $('#showPic').attr('src',data.res);

		}else if(data.info==false){

		    console(data.res);

        }

	});


</script>
</body>
</html>