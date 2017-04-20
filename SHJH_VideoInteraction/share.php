<?php
    
    error_reporting(E_ALL ^ E_DEPRECATED);
    
    include 'wx_selectMedia.php';
    
    $openid=$_REQUEST['openid'];
    
    $userArray = sel_media($openid);
    
    $imageUrl = "images/demo.jpg";
    
    $voiceUrl = "";
    
    for ($i=0;$i<count($userArray);$i++){
        
        if ($userArray[$i]['type']==1){
            
            $imageUrl = $userArray[$i]['media_url'];
            
        }else if($userArray[$i]['type']==2){
            
            $voiceUrl = $userArray[$i]['media_url'];
            
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
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
    //一般情况下，这样就可以自动播放了，但是一些奇葩iPhone机不可以
    document.getElementById('sounds').play();
    //必须在微信Weixin JSAPI的WeixinJSBridgeReady才能生效
    document.addEventListener("WeixinJSBridgeReady", function () {
        document.getElementById('sounds').play();
//         document.getElementById('sounds').pause();
    }, false);
</script>
<img src="images/icon.png" alt="" class="playMusic">
<audio  src="" loop="loop" id="newSound" preload>
    您的浏览器不支持 音频控件。
</audio>
<script>
    //一般情况下，这样就可以自动播放了，但是一些奇葩iPhone机不可以
    document.getElementById('newSound').play();
    //必须在微信Weixin JSAPI的WeixinJSBridgeReady才能生效
    document.addEventListener("WeixinJSBridgeReady", function () {
        document.getElementById('newSound').play();
   //     document.getElementById('newSound').pause();
    }, false);
</script>

<div id="shareCover">
    <div class="cover"></div>
    <img src="images/share.png" alt="">
</div>
</body>
<script type="text/javascript">
alert("<?php echo $voiceUrl ?>");
$('#showPic').attr('src',"<?php echo $imageUrl ?>");

$('#newSound').attr('src',"<?php echo $voiceUrl ?>");

</script>
</html>