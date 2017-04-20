<?php

//定义常量
define("AppID","wxf508733f4f12c592");

define("AppSecret", "d021083c9daba4eb1cd80ab2559dbf7c");

//打开数据库连接
function op_con(){
    //连接参数 本地
    $DB_Url ="127.0.0.1";
    $DB_Name = "CBI";
    $DB_pass = "66yinxiao";
//    $DB_Base = "wxadmin";
    $DB_Base = "brandx";

    //连接
    $con = mysql_connect($DB_Url,$DB_Name,$DB_pass);

    //判断
    if (!$con)
    {
        logInfo("数据库打开失败！");
        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db($DB_Base,$con);

    return $con;
}

//关闭数据库连接
function cls_con($cons){
    mysql_close($cons);
}

/*
 * 查询方法 sel_sql
 * 参数
 * $num(参数)(数组)(可以为空)
 * $table(表名)(字符串)(必填)
 * $whereKey(条件Key)(数组)(可以为空)
 * $whereValue(条件Value)(数组)(可以为空)
 * $orderBy(分组)(字符串)(可以为空)
 * $soft(排序[asc/desc])(字符串)(可以为空)
 * $limit(起始索引/总数目)(数字)(可以为空)
 * */
function sel_sql($num,$table,$whereKey,$whereValue,$orderBy,$soft,$limit){
    //打开数据库
    $cons = op_con();

    //sql查询 -- 拼装参数
    $sql = "SELECT ";

    //判断参数
    if ($num!=""){

        for ($i=0;$i<count($num);$i++){

            $sql.=$num[$i].",";

        }

        //去掉最后一个逗号
        $sql = rtrim($sql,',');

    }else {

        $sql.="*";

    }

    //判断表名
    if ($table!=""){

        $sql.= " from ".$table;

    }else {

        logInfo("查询参数出错 表名为空值");

        return false;

    }

    //判断条件
    if ($whereKey!="" && $whereValue!=""&& count($whereKey) == count($whereValue)){

        $sql.=" where ";

        for ($i=0;$i<count($whereKey);$i++){

            $sql.=$whereKey[$i]."=\"".$whereValue[$i]."\" and ";

        }

        //去掉最后一个逗号
        $sql = rtrim($sql," and ");

    }else {

        $sql.=" where 1=1";

    }

    //分组
    if ($orderBy!="" && $orderBy!=null){

        $sql.=" ORDER BY ".$orderBy;

        if ($soft!="" && $soft!=null){

            $sql.=" ".$soft;

        }

    }

    //分页
    if ($limit!=""){

        $sql.=" LIMIT ".$limit[0].",".$limit[1];

    }

    //设置编码格式
    mysql_query("set names utf8");

    //查询
    $ary = mysql_query($sql,$cons);

    //关闭数据库
    cls_con($cons);

    if ($ary!=false){
        //查询成功写入日志
        logInfo("查询成功-sql语句  =  ".$sql);

        $num = 0;

        $result = array();

        //读取结果集
        while($res = mysql_fetch_array($ary,MYSQL_ASSOC))
        {
            $result[$num] = $res;

            $num++;
        }

        //返回结果集
        return $result;

    }else {

        //查询失败写入日志
        logInfo("查询失败-sql语句  =  ".$sql);

        //返回错误
        return false;

    }

}

/*
 * 查询方法 sel_countSql
 * 参数
 * $num(参数)(数组)(可以为空)
 * $table(表名)(字符串)(必填)
 * $whereKey(条件Key)(数组)(可以为空)
 * $whereValue(条件Value)(数组)(可以为空)
 * */
function sel_countSql($table,$whereKey,$whereValue){
    //打开数据库
    $cons = op_con();

    //sql查询 -- 拼装参数
    $sql = "SELECT COUNT(*) as num ";

    //判断表名
    if ($table!=""){

        $sql.= "from ".$table;

    }else {

        logInfo("查询参数出错 表名为空值");

        return false;

    }

    //判断条件
    if ($whereKey!="" && $whereValue!=""&& count($whereKey) == count($whereValue)){

        $sql.=" where ";

        for ($i=0;$i<count($whereKey);$i++){

            $sql.=$whereKey[$i]."=\"".$whereValue[$i]."\" and ";

        }

        //去掉最后一个and
        $sql = rtrim($sql," and ");

    }else {

        $sql.=" where 1=1";

    }

    //查询
    $ary = mysql_query($sql,$cons);

    //关闭数据库
    cls_con($cons);

    if ($ary!=false){

        //查询成功写入日志
        logInfo("查询成功-sql语句  =  ".$sql);

        //读取结果集
        $res = mysql_fetch_array($ary,MYSQL_ASSOC);

        //返回结果集
        return $res['num'];

    }else {

        //查询失败写入日志
        logInfo("查询失败-sql语句  =  ".$sql);

        //返回错误
        return false;

    }

}

/*
 * 查询方法 sel_sql
 * 参数
 * $num(参数)(数组)(可以为空)
 * $table(表名)(字符串)(必填)
 * $whereKey(条件Key)(数组)(可以为空)
 * $whereValue(条件Value)(数组)(可以为空)
 * $orderBy(分组)(字符串)(可以为空)
 * $soft(排序[asc/desc])(字符串)(可以为空)
 * $limit(起始索引/总数目)(数字)(可以为空)
 * */
function query_sql($sql){
    //打开数据库
    $cons = op_con();

    //设置编码格式
    mysql_query("set names utf8");

    //查询
    $ary = mysql_query($sql,$cons);

    //关闭数据库
    cls_con($cons);

    if ($ary!=false){
        //查询成功写入日志
        logInfo("查询成功-sql语句  =  ".$sql);

        $num = 0;

        $result = array();

        //读取结果集
        while($res = mysql_fetch_array($ary,MYSQL_ASSOC))
        {
            $result[$num] = $res;

            $num++;
        }

        //返回结果集
        return $result;

    }else {

        //查询失败写入日志
        logInfo("查询失败-sql语句  =  ".$sql);

        //返回错误
        return false;

    }

}

/*
 * 插入方法 insert_sql
 * 参数
 * $numKey(参数Key)(数组)(必填)
 * $numValue(参数Value)(数组)(必填)
 * $table(表名)(字符串)(必填)
 * INSERT INTO Persons (FirstName, LastName, Age) VALUES ('Peter', 'Griffin', '35')
 * */

function insert_sql($numKey,$numValue,$table){

    //打开数据库
    $cons = op_con();

    //sql增加 -- 拼装参数
    $sql = "INSERT INTO ";

    //判断表名
    if ($table!=""){

        $sql.= $table;

    }else {

        logInfo("新增参数出错 表名为空值");

        return false;

    }

    //判断键参数
    if ($numKey!=""){

        $sql.=" (";

        for ($i=0;$i<count($numKey);$i++){

            $sql.= $numKey[$i].",";

        }

        //去掉最后一个逗号
        $sql = rtrim($sql,',');

        $sql.=") ";

    }else {

        logInfo("新增参数出错 参数为空值");

        return false;

    }

    //判断值参数
    if ($numValue!=""){

        $sql.="VALUES (";

        for ($i=0;$i<count($numValue);$i++){

            $sql.= "\"".$numValue[$i]."\",";

        }

        //去掉最后一个逗号
        $sql = rtrim($sql,',');

        $sql.=") ";

    }else {

        logInfo("新增参数出错 参数为空值");

        return false;

    }

    //设置编码格式
    mysql_query("set names utf8");

    //新增
    $res['res'] = mysql_query($sql,$cons);

    $res['id'] = mysql_insert_id($cons);

    //关闭数据库
    cls_con($cons);

    //判断结果并且打印日志
    if ($res['res']==true){

        logInfo("MySql语句插入成功 =".$sql);

    }else {

        logInfo("MySql语句插入出错 =".$sql);

    }

    //返回结果集
    return $res;

}

/*
 * 更新方法 upd_sql
 * 参数
 * $numKey(参数Key)(数组)(必填)
 * $numValue(参数Value)(数组)(必填)
 * $table(表名)(字符串)(必填)
 * $whereKey(条件Key)(数组)(可以为空)
 * $whereValue(条件Value)(数组)(可以为空)
 * */
function upd_sql($numKey,$numValue,$table,$whereKey,$whereValue){
    //打开数据库
    $cons = op_con();

    //sql查询 -- 拼装参数
    $sql = "UPDATE ";

    //判断表名
    if ($table!=""){

        $sql.= $table;

    }else {

        logInfo("更新参数出错 表名为空值");

        return false;

    }

    //判断参数
    if ($numKey!="" && $numValue!="" && count($numKey) == count($numValue)){

        $sql.=" SET ";

        for ($i=0;$i<count($numKey);$i++){

            $sql.= $numKey[$i]."=\"".$numValue[$i]."\",";

        }

        //去掉最后一个逗号
        $sql = rtrim($sql,',');

    }else {

        logInfo("更新参数出错 参数为空值");

        return false;

    }

    //判断条件
    if ($whereKey!="" && $whereValue!=""&& count($whereKey) == count($whereValue)){

        $sql.=" where ";

        for ($i=0;$i<count($whereKey);$i++){

            $sql.=$whereKey[$i]."=\"".$whereValue[$i]."\" and ";

        }

        //去掉最后一个逗号
        $sql = rtrim($sql," and ");

    }else {

        $sql.="where 1=1";

    }

    //设置编码格式
    mysql_query("set names utf8");

    //查询
    $res = mysql_query($sql,$cons);

    //关闭数据库
    cls_con($cons);

    //判断结果并且打印日志
    if ($res==true){

        logInfo("MySql语句更新成功 =".$sql);

    }else {

        logInfo("MySql语句更新出错 =".$sql);

    }

    //返回结果集
    return $res;
}

/*
 * 删除方法 del_sql
 * 参数
 * $table(表名)(字符串)(必填)
 * $whereKey(条件Key)(数组)(可以为空)
 * $whereValue(条件Value)(数组)(可以为空)
 * */
function del_sql($table,$whereKey,$whereValue){
    //打开数据库
    $cons = op_con();

    //sql查询 -- 拼装参数
    $sql = "DELETE FROM ";

    //判断表名
    if ($table!=""){

        $sql.= $table;

    }else {

        logInfo("删除参数出错 表名为空值");

        return false;

    }

    //判断条件
    if ($whereKey!="" && $whereValue!=""&& count($whereKey) == count($whereValue)){

        $sql.=" where ";

        for ($i=0;$i<count($whereKey);$i++){

            $sql.=$whereKey[$i]."=\"".$whereValue[$i]."\" and ";

        }

        //去掉最后一个逗号
        $sql = rtrim($sql," and ");

    }else {

        $sql.="where 1=1";

    }

    //设置编码格式
    mysql_query("set names utf8");

    //查询
    $res = mysql_query($sql,$cons);

    //关闭数据库
    cls_con($cons);

    //判断结果并且打印日志
    if ($res==true){

        logInfo("MySql语句删除成功 =".$sql);

    }else {

        logInfo("MySql语句删除出错 =".$sql);

    }

    //返回结果集
    return $res;
}

//获取Token
function getToken(){
    //链接
    $res = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.AppID.'&secret='.AppSecret);

    //获取微信token写入日志
    logInfo("token原始串 =".$res);

    //json转换
    $res = json_decode($res, true);

    //赋值
    $token = $res['access_token'];

    return $token;
}

//获取Ticket
function getTicket($token){
    //链接
    $url2 = sprintf("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=%s&type=jsapi",$token);

    //将链接放入字符串
    $res = file_get_contents($url2);

    $res = json_decode($res, true);

    $ticket = $res['ticket'];

    return $ticket;
}

//获取用户授权流程
function userAuthorizationFlow($code,$state){

    $tokenArray = wx_UserToken($code, $state);

    if ($tokenArray==false){

        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf508733f4f12c592&redirect_uri=http%3a%2f%2fwww.brandxspace.com%2fwx_media_voice%2findex.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";

        echo "<script language=\"javascript\">";

        echo "location.href=\"$url\"";

        echo "</script>";

    }

    $userInfo = wx_UserInfo($tokenArray['openid'], $tokenArray['token']);

    return $userInfo;
}

//用户授权-获取用户信息-token
function wx_UserToken($code,$state){

    //获取token链接
    $token_Url = sprintf("https://api.weixin.qq.com/sns/oauth2/access_token?appid=%s&secret=%s&code=%s&grant_type=authorization_code",AppID,AppSecret,$code);

    //将链接放入字符串
    $token_Urls = file_get_contents($token_Url);

    //返回值记入日志
    logInfo("token返回值 = ".$token_Urls);

    //json转译
    $tokenUrl = json_decode($token_Urls, true);

    //如果是错误码 就返回false
    if(isset($tokenUrl['errcode']) == true){

        return false;

    }

    //提取参数
    $access_token = $tokenUrl['access_token'];

    $refresh_token = $tokenUrl['refresh_token'];

    $openid = $tokenUrl['openid'];

    $scope = $tokenUrl['scope'];

    //设置插入token数据参数
    $token_time = time();

    $token_table = "wxrz_token";

    $token_numKey = array("openid","access_token","refresh_token","scope","token_time");

    $token_numValue = array($openid,$access_token,$refresh_token,$scope,$token_time);

    //拼接更新参数
    $token_res = insert_sql($token_numKey, $token_numValue, $token_table);

    if ($token_res['res']!=false){

        logInfo("插入数据库成功 - token = ".$access_token);

    }else {

        logInfo("插入数据库出错 - token = ".$access_token);

    }

    $tokenArray = array(

        "openid" => $openid,

        "token" => $access_token

    );

    return $tokenArray;

}

//用户授权-获取用户信息-userInfo
function wx_UserInfo($openid,$userToken){

    //请求用户数据
    $userInfo_Url = sprintf("https://api.weixin.qq.com/sns/userinfo?access_token=%s&openid=%s&lang=zh_CN",$userToken,$openid);

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

        if ($user_res!=false){

            logInfo("用户信息更新成功 ");

        }else {

            logInfo("用户信息更新出错");

        }

    }else {

        $user_numKey = array("openid","nickname","sex","country","city","province","headimgurl","add_time");

        $user_numValue = array($userOpenID,$userNickName,$userSex,$userCountry,$userCity,$userProvince,$userHeadImgUrl,$userInfo_Time);

        $user_res = insert_sql($user_numKey, $user_numValue, $user_table);

        if ($user_res!=false){

            logInfo("用户信息插入数据库成功 = ".$user_res['id']);

        }else {

            logInfo("用户信息插入数据库出错");

        }
    }

    $userInfoResult = array(
        "openid" => $userOpenID,
        "NickName" => $userNickName,
        "Sex" => $userSex,
        "Country" => $userCountry,
        "City" => $userCity,
        "Province" => $userProvince,
        "HeadImgUrl" => $userHeadImgUrl
    );

    return $userInfoResult;

}

//检查并返回token/ticket
function resTT($type,$timestamp,$token){

    //声明参数
    if ($type=="token"){

        $TT_table = "wx_access_token";

    }else if($type=="ticket"){

        $TT_table = "wx_jsapi_ticket";

    }else {

        logInfo("type类型错误!");

        return false;

    }

    //查询
    $result = sel_sql("", $TT_table,"","","","","");

    //判断数据库是否存在token/ticket
    if (count($result)>0){

        //存在 判断是否超过有效时间(7200)
        if (($timestamp-$result[0]['wx_time'])>7000){

            if ($type=="token"){

                $TT = getToken();

                $TT_key = array("access_token","wx_time");

            }else if($type=="ticket"){

                $TT = getTicket($token);

                $TT_key = array("jsapi_ticket","wx_time");

            }

            $TT_value = array($TT,$timestamp);

            $TT_whereKey = array("id");

            $TT_whereValue = array($result[0]['id']);

            $upd_res = upd_sql($TT_key, $TT_value, $TT_table, $TT_whereKey, $TT_whereValue);

            if ($upd_res!=false){

                logInfo("更新".$type."成功!");

            }else {

                logInfo("更新".$type."失败!");

            }

        }else {

            if ($type=="token"){

                $TT = $result['0']['access_token'];

            }else if($type=="ticket"){

                $TT = $result['0']['jsapi_ticket'];

            }

        }

    }else {

        if ($type=="token"){

            $TT = getToken();

            $TT_key = array("access_token","wx_time");

        }else if($type=="ticket"){

            $TT = getTicket($token);

            $TT_key = array("jsapi_ticket","wx_time");

        }

        $TT_value = array($TT,$timestamp);

        $ins_res = insert_sql($TT_key, $TT_value, $TT_table);

        if ($ins_res['res']!=false){

            logInfo("插入".$type."成功!");

        }else {

            logInfo("插入".$type."失败!");

        }
    }

    return $TT;

}

//下载微信多媒体文件
function wx_downloadMedia($url){

    $media_curl = curl_init($url);

    curl_setopt($media_curl, CURLOPT_HEADER, 0);

    curl_setopt($media_curl, CURLOPT_NOBODY, 0);

    curl_setopt($media_curl, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($media_curl, CURLOPT_SSL_VERIFYHOST, false);

    curl_setopt($media_curl, CURLOPT_RETURNTRANSFER, 1);

    $data = curl_exec($media_curl);

    $dataInfo = curl_getinfo($media_curl);

    curl_close($media_curl);

    $mediaInfo = array_merge(array('header' => $dataInfo),array('body' => $data));

    return $mediaInfo;
}

//保存微信多媒体文件
function wx_saveMedia($fileName,$fileContent){

    $file = fopen($fileName, 'w');

    if (false !== $file){

        if (false !== fwrite($file,$fileContent)){

            fclose($file);

        }

    }

}

function curlPost($url,$post){

    $ch = curl_init();

    curl_setopt($ch,CURLOPT_URL,$url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_HEADER, false);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    curl_setopt($ch, CURLOPT_POST,true);

    curl_setopt($ch, CURLOPT_POSTFIELDS,$post);

    $returnInfo = curl_exec($ch);

    curl_close ($ch);

    return $returnInfo;

}

//下载图片
function saveImage($url,$saveURL){

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_POST, 0);

    curl_setopt($ch,CURLOPT_URL,$url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $file_content = curl_exec($ch);

    curl_close($ch);

    $downloaded_file = fopen($saveURL, 'w');

    fwrite($downloaded_file, $file_content);

    fclose($downloaded_file);

}

//改变图片大小
function resize_image($url,$type,$xSize,$ySize)
{
    $arr = getimagesize($url);

    switch ($type){

        case "jpg":

            header("Content-type: image/jpg");

            $image = imagecreatefromjpeg($url);

            $image2 = imagecreatetruecolor($xSize, $ySize);

            imagecopyresampled($image2, $image, 0, 0, 0, 0,$xSize,$ySize,$arr[0], $arr[1]);

            imagejpeg($image2,$url);

            break;

        case "png":

            header("Content-type: image/png");

            $image = imagecreatefrompng($url);

            $image2 = imagecreatetruecolor($xSize, $ySize);

            imagecopyresampled($image2, $image, 0, 0, 0, 0,$xSize,$ySize,$arr[0], $arr[1]);

            imagepng($image2,$url);

            break;

        case "gif":

            header("Content-type: image/gif");

            $image = imagecreatefromgif($url);

            $image2 = imagecreatetruecolor($xSize, $ySize);

            imagecopyresampled($image2, $image, 0, 0, 0, 0,$xSize,$ySize,$arr[0], $arr[1]);

            imagegif($image2,$url);

            break;

    }

    imagedestroy($image2);

}

//写入文档
function logRemark($name,$info){

    $log = fopen($name,"r+") or die("Unable to open file!");

    fwrite($log,$info);

    fclose($log);

}

//日志文档
function logInfo($info){

    $info = date('Y-m-d H:i:s',time())."  ------>>>>>>  ".$info."\r\n";

    $log = fopen("infoLog.txt","a+") or die("Unable to open file!");

    fwrite($log,$info);

    fclose($log);

}

?>