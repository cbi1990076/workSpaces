<?php
/**
  * wechat php test
  */

defined("TOKEN", "ZhongJia");

logInfo("进来了!");

$echoStr = $_GET["echostr"];

logInfo($echoStr);

if($this->checkSignature()){
	echo $echoStr;
	exit;
}

	
function checkSignature()
{
	if (!defined("TOKEN")) {
		throw new Exception('TOKEN is not defined!');
	}
	
	$signature = $_GET["signature"];
	$timestamp = $_GET["timestamp"];
	$nonce = $_GET["nonce"];
	//写入文件
	logInfo($signature);
	logInfo($timestamp);
	logInfo($nonce);
	
	$token = TOKEN;
	$tmpArr = array($token, $timestamp, $nonce);

	sort($tmpArr, SORT_STRING);
	$tmpStr = implode( $tmpArr );
	$tmpStr = sha1( $tmpStr );
	
	if( $tmpStr == $signature ){
		return true;
	}else{
		return false;
	}
}

//日志
function logInfo($info){
	$info = date('Y-m-d H:i:s',time())."  ------>>>>>>  ".$info."\r\n";
	$log = fopen("infoLog.txt","a+") or die("Unable to open file!");
	fwrite($log,$info);
	//结束日志
	fclose($log);
}


?>