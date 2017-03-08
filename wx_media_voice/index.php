<?php
    
    error_reporting(E_ALL ^ E_DEPRECATED);
    
    include 'FunctionClass.php';
        
    $code=$_REQUEST['code'];
    
    $state=$_REQUEST['state'];

    $userInfo = userAuthorizationFlow($code, $state);

    $timestamp = time();

?>
<!DOCTYPE html>
<html>
	<head>
        <meta charset="UTF-8">
        <title>元宵·温情</title>
        <link rel="stylesheet" href="lib/animate.min.css">
        <link rel="stylesheet" href="lib/inedx.css">
        <script type="text/javascript">
            openId      = "<?php echo $userInfo['openid'] ?>";
            timestamp   = "<?php echo $timestamp ?>";
        </script>
        <script src="lib/jquery-2.2.0.min.js"></script>
        <script src="lib/prefixfree.min.js"></script>
        <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <script src="lib/shareWXIndex.js"></script>
        <script src="lib/rem.js"></script>
        <script src="lib/index.js"></script>

	</head>
	<body>
        <div class="loading">
           <div class="lTop">
               <img src="images/wordA.png" alt="" class="word2016">
               <img src="images/wordB.png" alt="" class="word2017">
           </div>
            <div class="light">
                <img src="images/lightL.png" alt="" class="lightL">
                <img src="images/lightR.png" alt="" class="lightR">
            </div>
        </div>
        <div class="main">
            <!--鸡和祥云-->
            <img src="images/cloud.jpg" alt="" class="cloud">
            <img src="images/ji.png" alt="" class="chick">
            <!--页面上部加载图片-->
            <div class="top">
                <div class="blackCover"></div>
                <img id="box_pic" src="images/box.png" alt="" class="boxShadow">
                <img id="text_pic" src="images/text.png" alt="" class="text">
                <!--上传后修改路径-->
                <div id="pic">
                    <img id="picture" src="images/demo.jpg" alt="">
                </div>
            </div>
            <!--页面中间录音-->
            <div id="timeNumber" class="mid">
                
            </div>
            <!--页面底部-->
            <div class="bot">
                <div class="fir">
                    <img src="images/play.png" alt="" class="play">
                    <img src="images/pause.png" alt="" class="pause">
                </div>
                <div class="sec">
                    <img src="images/start.png" alt="" class="start">
                    <img src="images/stop.png" alt="" class="stop">
                    <img src="images/reload.png" alt="" class="reload">
                </div>
                <div class="the">
                    <img src="images/done.png" alt="" class="done">
                </div>
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
    </body>
</html>