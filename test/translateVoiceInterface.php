<?php

    error_reporting(E_ALL ^ E_DEPRECATED);

    include 'FunctionClass.php';

    $code=$_REQUEST['code'];

    $state=$_REQUEST['state'];

    $userInfo = userAuthorizationFlow($code, $state);

    $timestamp = time();

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>智能语音识别接口测试</title>
        <script type="text/javascript">
            openId      = "<?php echo $userInfo['openid'] ?>";
            timestamp   = "<?php echo $timestamp ?>";
        </script>
        <script src="lib/jquery-2.2.0.min.js"></script>
        <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <script src="lib/shareWXIndex.js"></script>
        <script src="lib/index.js"></script>
    </head>
    <body>

    </body>
</html>
