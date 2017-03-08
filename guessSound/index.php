<?php
    
    error_reporting(E_ALL ^ E_DEPRECATED);
    
    include 'FunctionClass.php';
        
    $code=$_REQUEST['code'];
    
    $state=$_REQUEST['state'];
    
    $tokenArray = wx_UserToken($code, $state);

    $userInfo = wx_UserInfo($tokenArray['openid'], $tokenArray['token']);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="lib/inedx.css">
    <script src="lib/prefixfree.min.js"></script>
    <script src="lib/rem.js"></script>
    <script src="lib/jquery-2.2.0.min.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script src="lib/shareWXIndex.js"></script>
	<script src="lib/inedx.js"></script>
    <script>
        openId="<?php echo $userInfo['openid'] ?>";
        canPlay;
        console.log(openId);
    </script>
</head>
<body>
<div id="loading">
    <img src="images/ball.gif" alt="" class="ball">
    <div class="crack">
        <img src="images/qiua/01.jpg" alt="">
        <img src="images/qiua/02.jpg" alt="">
        <img src="images/qiua/03.jpg" alt="">
        <img src="images/qiua/04.jpg" alt="">
        <img src="images/qiua/05.jpg" alt="">
        <img src="images/qiua/06.jpg" alt="">
        <img src="images/qiua/07.jpg" alt="">
        <img src="images/qiua/08.jpg" alt="">
        <img src="images/qiua/09.jpg" alt="">
        <img src="images/qiua/10.jpg" alt="">
        <img src="images/qiua/11.jpg" alt="">
        <img src="images/qiua/12.jpg" alt="">
        <img src="images/qiua/13.jpg" alt="">
        <img src="images/qiua/14.jpg" alt="">
        <img src="images/qiua/15.jpg" alt="">
        <img src="images/qiua/16.jpg" alt="">
        <img src="images/qiua/17.jpg" alt="">
        <img src="images/qiua/18.jpg" alt="">
        <img src="images/qiua/19.jpg" alt="">
        <img src="images/qiua/20.jpg" alt="">
        <img src="images/qiua/21.jpg" alt="">
        <img src="images/qiua/22.jpg" alt="">
        <img src="images/qiua/23.jpg" alt="">
        <img src="images/qiua/24.jpg" alt="">
        <img src="images/qiua/25.jpg" alt="">
        <img src="images/qiua/26.jpg" alt="">
        <img src="images/qiua/27.jpg" alt="">
        <img src="images/qiua/28.jpg" alt="">
        <img src="images/qiua/29.jpg" alt="">
        <img src="images/qiua/30.jpg" alt="">
        <img src="images/qiua/31.jpg" alt="">
        <img src="images/qiua/32.jpg" alt="">
        <img src="images/qiua/33.jpg" alt="">
        <img src="images/qiua/34.jpg" alt="">
        <img src="images/qiua/35.jpg" alt="">
        <img src="images/qiua/36.jpg" alt="">
        <img src="images/qiua/37.jpg" alt="">
        <img src="images/qiua/38.jpg" alt="">
        <img src="images/qiua/39.jpg" alt="">
        <img src="images/qiua/40.jpg" alt="">
        <img src="images/qiua/41.jpg" alt="">
        <img src="images/qiua/42.jpg" alt="">
        <img src="images/qiua/43.jpg" alt="">
        <img src="images/qiua/44.jpg" alt="">
        <img src="images/qiua/45.jpg" alt="">
        <img src="images/qiua/46.jpg" alt="">
        <img src="images/qiua/47.jpg" alt="">
        <img src="images/qiua/48.jpg" alt="">
        <img src="images/qiua/49.jpg" alt="">
        <img src="images/qiua/50.jpg" alt="">
    </div>
    
</div>
<div id="startGame">
    <div class="top">
        <img src="images/moonBall.png" alt="" class="planet">
    </div>
    <img src="images/startWord.png" alt="" class="sWord">
    <img src="images/spaceMan.png" alt="" class="man">
    <div class="sBottom">
        <img src="images/playWord.png" alt="" class="playWord">
        <img src="images/playBtn.png" alt="" class="playBtn">
        <img src="images/playLight.png" alt="" class="playLight">
        <img src="images/sBottomWord.png" alt="" class="BottomWord">
    </div>
</div>
<div id="Main">
    <ul>
        <li class="question">
            <div class="mQues">
                <audio  src="images/sound/xingqiudazhan.mp3" loop="loop" class="sounds" preload>
                    您的浏览器不支持 音频控件。
                </audio>
                <div class="mQtop">
                    <img src="images/rotate.png" alt="" class="rotate">
                    <img src="images/box.png" alt="" class="qBox">
                    <img src="images/waveA.gif" alt="" class="waveA">
                    <img src="images/waveB.gif" alt="" class="waveB">
                </div>
                <div class="mQmid">
                    <ul>
                        <li choose="1">星球大战</li>
                        <li choose="0">星际迷航</li>
                        <li choose="0">星际穿越</li>
                    </ul>
                </div>
            </div>
            <div class="mResult">
                <div class="mRtop">
                    <img src="images/rateLeft.png" alt="" class="rateLeft">
                    <img src="images/rateRight.png" alt="" class="rateRight">
                    <img src="images/starwars.jpg" alt="" class="rateMid">
                </div>
                <div class="mRmain">
                    《星球大战》系列电影是由卢卡斯电影公司出品的科幻电影。卢卡斯电影公司首先于1977年推出了《星球大战》，之后又分别在1980年和1983年推出了《星球大战2》和《星球大战3》。之后又推出了星球大战前传三部曲，前传1、2、3分别于1999年、2002年和2005年上映。
                </div>
                <div class="rBottom">
                    <img src="images/nextBegin.png" alt="" class="nextBegin">
                </div>
            </div>
        </li>
        <li class="question">
            <div class="mQues">
                <audio  src="images/sound/bianxingjingang.mp3" loop="loop" class="sounds" preload>
                    您的浏览器不支持 音频控件。
                </audio>
                <div class="mQtop">
                    <img src="images/rotate.png" alt="" class="rotate">
                    <img src="images/box.png" alt="" class="qBox">
                    <img src="images/waveA.gif" alt="" class="waveA">
                    <img src="images/waveB.gif" alt="" class="waveB">
                </div>
                <div class="mQmid">
                    <ul>
                        <li choose="0">环太平洋</li>
                        <li choose="1">变形金刚</li>
                        <li choose="0">铁甲钢拳</li>
                    </ul>
                </div>
            </div>
            <div class="mResult">
                <div class="mRtop">
                    <img src="images/rateLeft.png" alt="" class="rateLeft">
                    <img src="images/rateRight.png" alt="" class="rateRight">
                    <img src="images/bianxingjingang.jpg" alt="" class="rateMid">
                </div>
                <div class="mRmain">
                    《变形金刚》是历史上最成功的商业动画之一，它在玩具市场和音像市场上取得的成功是空前巨大的，以至于80年代一度风靡全球，在亚欧美等多个国家都兴起了一股“变形”热，让“transformers”成为全世界家喻户晓的名词。
                </div>
                <div class="rBottom">
                    <img src="images/nextBegin.png" alt="" class="nextBegin">
                </div>
            </div>
        </li>
        <li class="question">
            <div class="mQues">
                <audio  src="images/sound/daomengkongjian.mp3" loop="loop" class="sounds" preload>
                    您的浏览器不支持 音频控件。
                </audio>
                <div class="mQtop">
                    <img src="images/rotate.png" alt="" class="rotate">
                    <img src="images/box.png" alt="" class="qBox">
                    <img src="images/waveA.gif" alt="" class="waveA">
                    <img src="images/waveB.gif" alt="" class="waveB">
                </div>
                <div class="mQmid">
                    <ul>
                        <li choose="0">穆赫兰道</li>
                        <li choose="1">盗梦空间</li>
                        <li choose="0">蝴蝶效应</li>
                    </ul>
                </div>
            </div>
            <div class="mResult">
                <div class="mRtop">
                    <img src="images/rateLeft.png" alt="" class="rateLeft">
                    <img src="images/rateRight.png" alt="" class="rateRight">
                    <img src="images/daomengkongjian.jpg" alt="" class="rateMid">
                </div>
                <div class="mRmain">
                    《盗梦空间》影片剧情游走于梦境与现实之间，被定义为“发生在意识结构内的当代动作科幻片”。影片讲述由莱昂纳多·迪卡普里奥扮演的造梦师，带领约瑟夫·高登-莱维特、艾伦·佩吉扮演的特工团队，进入他人梦境，从他人的潜意识中盗取机密，并重塑他人梦境的故事。
                </div>
                <div class="rBottom">
                    <img src="images/nextBegin.png" alt="" class="nextBegin">
                </div>
            </div>
        </li>
        <li class="question">
            <div class="mQues">
                <audio  src="images/sound/gangtiexia.mp3" loop="loop" class="sounds" preload>
                    您的浏览器不支持 音频控件。
                </audio>
                <div class="mQtop">
                    <img src="images/rotate.png" alt="" class="rotate">
                    <img src="images/box.png" alt="" class="qBox">
                    <img src="images/waveA.gif" alt="" class="waveA">
                    <img src="images/waveB.gif" alt="" class="waveB">
                </div>
                <div class="mQmid">
                    <ul>
                        <li choose="0">蝙蝠侠</li>
                        <li choose="1">钢铁侠</li>
                        <li choose="0">蜘蛛侠</li>
                    </ul>
                </div>
            </div>
            <div class="mResult">
                <div class="mRtop">
                    <img src="images/rateLeft.png" alt="" class="rateLeft">
                    <img src="images/rateRight.png" alt="" class="rateRight">
                    <img src="images/gangtiexia.jpg" alt="" class="rateMid">
                </div>
                <div class="mRmain">
                    《星球大战》系列电影是由卢卡斯电影公司出品的科幻电影。卢卡斯电影公司首先于1977年推出了《星球大战》，之后又分别在1980年和1983年推出了《星球大战2》和《星球大战3》。之后又推出了星球大战前传三部曲，前传1、2、3分别于1999年、2002年和2005年上映。
                </div>
                <div class="rBottom">
                    <img src="images/nextBegin.png" alt="" class="nextBegin">
                </div>
            </div>
        </li>
        <li class="question">
            <div class="mQues">
                <audio  src="images/sound/shenghuaweiji.mp3" loop="loop" class="sounds" preload>
                    您的浏览器不支持 音频控件。
                </audio>
                <div class="mQtop">
                    <img src="images/rotate.png" alt="" class="rotate">
                    <img src="images/box.png" alt="" class="qBox">
                    <img src="images/waveA.gif" alt="" class="waveA">
                    <img src="images/waveB.gif" alt="" class="waveB">
                </div>
                <div class="mQmid">
                    <ul>
                        <li choose="0">僵尸之地</li>
                        <li choose="0">惊变21天</li>
                        <li choose="1">生化危机</li>
                    </ul>
                </div>
            </div>
            <div class="mResult">
                <div class="mRtop">
                    <img src="images/rateLeft.png" alt="" class="rateLeft">
                    <img src="images/rateRight.png" alt="" class="rateRight">
                    <img src="images/shenghuaweiji.jpg" alt="" class="rateMid">
                </div>
                <div class="mRmain">
                    《生化危机》故事发生在安布雷拉（保护伞）公司的生物工程实验室——“蜂巢”里，数百名遗传学、生物工程学专家正在进行一项科学研究，一种病毒突然爆发了并迅速传播着，而超级计算机“火焰女皇”为了控制病毒不让其外泄到地面上，将蜂巢全部封闭，病毒很快感染了所有的工作人员并引发的更大的灾难。
                </div>
                <div class="rBottom">
                    <img src="images/nextBegin.png" alt="" class="nextBegin">
                </div>
            </div>
        </li>
        <li class="question">
            <div class="mQues">
                <audio  src="images/sound/taikongmanyou2001.mp3" loop="loop" class="sounds" preload>
                    您的浏览器不支持 音频控件。
                </audio>
                <div class="mQtop">
                    <img src="images/rotate.png" alt="" class="rotate">
                    <img src="images/box.png" alt="" class="qBox">
                    <img src="images/waveA.gif" alt="" class="waveA">
                    <img src="images/waveB.gif" alt="" class="waveB">
                </div>
                <div class="mQmid">
                    <ul>
                        <li choose="1">太空漫游2001</li>
                        <li choose="0">银河系漫游指南</li>
                        <li choose="0">独立日</li>
                    </ul>
                </div>
            </div>
            <div class="mResult">
                <div class="mRtop">
                    <img src="images/rateLeft.png" alt="" class="rateLeft">
                    <img src="images/rateRight.png" alt="" class="rateRight">
                    <img src="images/taikongmanyou2001.jpg" alt="" class="rateMid">
                </div>
                <div class="mRmain">
                    《漫游太空2001》由斯坦利·库布里克执导，根据科幻小说家亚瑟·克拉克小说改编的美国科幻电影，被誉为“现代科幻电影技术的里程碑”。本片获得当年最佳美术指导、最佳导演、最佳编剧等4项奥斯卡奖提名，获最佳视觉效果奖，获1968年英国电影学院最佳摄影、最佳音响、最佳美工奖。                </div>
                <div class="rBottom">
                    <img src="images/nextBegin.png" alt="" class="nextBegin">
                </div>
            </div>
        </li>
        <li class="question">
            <div class="mQues">
                <audio  src="images/sound/walle.mp3" loop="loop" class="sounds" preload>
                    您的浏览器不支持 音频控件。
                </audio>
                <div class="mQtop">
                    <img src="images/rotate.png" alt="" class="rotate">
                    <img src="images/box.png" alt="" class="qBox">
                    <img src="images/waveA.gif" alt="" class="waveA">
                    <img src="images/waveB.gif" alt="" class="waveB">
                </div>
                <div class="mQmid">
                    <ul>
                        <li choose="1">机器人总动员</li>
                        <li choose="0">超能陆战队</li>
                        <li choose="0">玩具总动员</li>
                    </ul>
                </div>
            </div>
            <div class="mResult">
                <div class="mRtop">
                    <img src="images/rateLeft.png" alt="" class="rateLeft">
                    <img src="images/rateRight.png" alt="" class="rateRight">
                    <img src="images/walle.jpg" alt="" class="rateMid">
                </div>
                <div class="mRmain">
                    《机器人总动员》由皮克斯动画工作室进行制作，华特·迪士尼电影工作室电影公司负责发行。影片于2008年6月27日在美国上映。故事讲述了地球上的清扫型机器人瓦力偶遇并爱上了机器人夏娃后，追随她进入太空历险的一系列故事。影片的全球票房累计超过5.3亿美元，曾获得第81届奥斯卡最佳动画长片奖。
                </div>
                <div class="rBottom">
                    <img src="images/nextBegin.png" alt="" class="nextBegin">
                </div>
            </div>
        </li>
        <li class="question">
            <div class="mQues">
                <audio  src="images/sound/xingqiujueqi.mp3" loop="loop" class="sounds" preload>
                    您的浏览器不支持 音频控件。
                </audio>
                <div class="mQtop">
                    <img src="images/rotate.png" alt="" class="rotate">
                    <img src="images/box.png" alt="" class="qBox">
                    <img src="images/waveA.gif" alt="" class="waveA">
                    <img src="images/waveB.gif" alt="" class="waveB">
                </div>
                <div class="mQmid">
                    <ul>
                        <li choose="0">金刚</li>
                        <li choose="0">12猴子</li>
                        <li choose="1">猩球崛起</li>
                    </ul>
                </div>
            </div>
            <div class="mResult">
                <div class="mRtop">
                    <img src="images/rateLeft.png" alt="" class="rateLeft">
                    <img src="images/rateRight.png" alt="" class="rateRight">
                    <img src="images/xingqiujueqi.jpg" alt="" class="rateMid">
                </div>
                <div class="mRmain">
                    《猩球崛起》，剧情主要讲述人猿进化为高级智慧生物、进而攻占地球之前的种种际遇，主题是带有警世性质的——人类疯狂的野心所产生的恶果。影片获得了第39届安妮奖最佳真人电影角色动画奖等奖项。</div>
                <div class="rBottom">
                    <img src="images/nextBegin.png" alt="" class="nextBegin">
                </div>
            </div>
        </li>
        <li class="question">
            <div class="mQues">
                <audio  src="images/sound/zhongjiezhe.mp3" loop="loop" class="sounds" preload>
                    您的浏览器不支持 音频控件。
                </audio>
                <div class="mQtop">
                    <img src="images/rotate.png" alt="" class="rotate">
                    <img src="images/box.png" alt="" class="qBox">
                    <img src="images/waveA.gif" alt="" class="waveA">
                    <img src="images/waveB.gif" alt="" class="waveB">
                </div>
                <div class="mQmid">
                    <ul>
                        <li choose="0">机械战警</li>
                        <li choose="1">终结者</li>
                        <li choose="0">阿凡达</li>
                    </ul>
                </div>
            </div>
            <div class="mResult">
                <div class="mRtop">
                    <img src="images/rateLeft.png" alt="" class="rateLeft">
                    <img src="images/rateRight.png" alt="" class="rateRight">
                    <img src="images/zhongjiezhe.jpg" alt="" class="rateMid">
                </div>
                <div class="mRmain">
                    《终结者》。《电影周刊》在评选20世纪最值得收藏的一部电影时，此片以最高票数位居第一。而这部电影居然是一部早在30多年前就拍摄完毕的科幻片，这在电脑特效技术已经相当完善的2016年可谓一大新闻。表现出的强烈的美国式个人英雄主义风格和出色的电影平衡性和完美特效是分不开的。
                </div>
                <div class="rBottom">
                    <img src="images/nextBegin.png" alt="" class="nextBegin">
                </div>
            </div>
        </li>
        <li class="question">
            <div class="mQues">
                <audio  src="images/sound/zhuluojigongyuan.mp3" loop="loop" class="sounds" preload>
                    您的浏览器不支持 音频控件。
                </audio>
                <div class="mQtop">
                    <img src="images/rotate.png" alt="" class="rotate">
                    <img src="images/box.png" alt="" class="qBox">
                    <img src="images/waveA.gif" alt="" class="waveA">
                    <img src="images/waveB.gif" alt="" class="waveB">
                </div>
                <div class="mQmid">
                    <ul>
                        <li choose="1">侏罗纪公园</li>
                        <li choose="0">指环王</li>
                        <li choose="0">哥斯拉</li>
                    </ul>
                </div>
            </div>
            <div class="mResult">
                <div class="mRtop">
                    <img src="images/rateLeft.png" alt="" class="rateLeft">
                    <img src="images/rateRight.png" alt="" class="rateRight">
                    <img src="images/zhuluojigongyuan.jpg" alt="" class="rateMid">
                </div>
                <div class="mRmain">
                    《侏罗纪公园》，影片主要讲述了哈蒙德博士召集大批科学家利用凝结在琥珀中的史前蚊子体内的恐龙血液提取出恐龙的遗传基因，将已绝迹6500万年的史前庞然大物复生，使整个努布拉岛成为恐龙的乐园，即“侏罗纪公园”。</div>
                <div class="rBottom">
                    <img src="images/nextBegin.png" alt="" class="nextBegin">
                </div>
            </div>
        </li>
    </ul>

</div>
<div id="result">
    <img src="images/lines.png" alt="" class="lines">
    <div class="rTop">
        <img src="images/topWordResult.png" alt="" class="rTopWord">
        <div class="rScore">
            <p class="score"><span>90</span>分</p>
            <p class="rate"> 你击败了<span id="rate">80</span>%的人</p>
        </div>
    </div>
    <div class="rMid">
        <div class="rMT">
            <img src="images/moon.png" alt="">
            <img src="images/whitePoint.png" alt="">
        </div>
        <img src="images/logo.png" alt="" class="rLogo">
        <img src="images/resultWord.png" alt="" class="rWord">
    </div>
    <div class="rBtn">
        <img src="images/reStart.png" alt="" class="reStart">
        <img src="images/reShare.png" alt="" class="reShare">
    </div>
</div>
<div id="share">
    <img src="images/share.png" alt="">
    <div></div>
</div>
<audio  src="images/typingSound.mp3" loop="loop" id="typingSound" preload>
    您的浏览器不支持 音频控件。
</audio>
<script>
    //一般情况下，这样就可以自动播放了，但是一些奇葩iPhone机不可以
    document.getElementById('typingSound').play();
    //必须在微信Weixin JSAPI的WeixinJSBridgeReady才能生效
    document.addEventListener("WeixinJSBridgeReady", function () {
        document.getElementById('typingSound').play();
    }, false);
</script>
</body>
</html>