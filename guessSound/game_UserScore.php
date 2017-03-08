<?php

    //屏蔽错误
    error_reporting(E_ALL ^ E_DEPRECATED);
    
    //引入公共方法
    include 'FunctionClass.php';

    $score = $_REQUEST['score'];
    
    $oid = $_REQUEST["openid"];

    $oid_numKey = array("openid");
    
    $oid_numValue = array($oid);
    
    $game_table = "wx_userscore";
    
    $sel_res = sel_countSql($game_table, $oid_numKey, $oid_numValue);
    
    if ($sel_res > 0){
        
        $game_upd_numKey = array("score");
        
        $game_upd_numValue = array($score);
        
        $upd_res = upd_sql($game_upd_numKey, $game_upd_numValue, $game_table, $oid_numKey, $oid_numValue);
        
        if ($upd_res != false) {
            
            logInfo("更新用户分数成功！");
            
            
        }else {
            
            logInfo("更新用户分数失败！");
            
        }
        
    }else {
        
        $game_ins_numKey = array("openid","score");
        
        $game_ins_numValue = array($oid,$score);
        
        $ins_res = insert_sql($game_ins_numKey, $game_ins_numValue, $game_table);
        
        if ($ins_res != false) {
        
            logInfo("插入用户分数成功！");
        
        }else {
        
            logInfo("插入用户分数失败！");
        
        }
        
    }
    
    $game_sel_numKey = array("score");
    
    $all_sql = sel_sql($game_sel_numKey,$game_table,"","");
    
    $num = 0;
    
    for ($i = 0; $i < count($all_sql); $i++) {
    
        if ($score >= $all_sql[$i]['score']) {
    
            $num++;
    
        }
    
    }
    
    $victory = ($num/count($all_sql))*100;
    
    $victoryNum = substr($victory, 0 , 2);
    
    $userInfo_name = array("nickname");
    
    $userInfo_Table = "wx_userinfo";
    
    $userName = sel_sql($userInfo_name, $userInfo_Table, $oid_numKey, $oid_numValue);
    
    if ($userName==false){
        
        $userName="未知用户";
        
    }
    
    $gameResult = array(
        "info" => true,
        "openid" => $oid,
        "userName" => $userName,
        "victory" => $victoryNum
    );
    
    $userJson = json_encode($gameResult);
    
	logInfo($userJson);

    echo $userJson;
    
    
    
?>