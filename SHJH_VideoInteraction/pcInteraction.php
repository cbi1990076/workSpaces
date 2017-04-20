<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    //声明参数
    $cons = op_con();
    
    $sql = "SELECT * FROM shjhHD";
    
    $ary = mysql_query($sql);
    
    $row = mysql_fetch_array($ary,MYSQL_ASSOC);
    
    if ($row['type']==3){
        $sql_update = "Update shjhHD Set type=0";
        mysql_query($sql_update);
    }
    
    cls_con($cons);
    
    echo $row['type'];

    //打开数据库连接
    function op_con(){
        //连接参数
        $DB_Url ="210.51.187.90";
        $DB_Name = "jiadi32";
        $DB_pass = "Zhongjia@123";
        $DB_Base = "jiadi32";
        
        //连接
        $con = mysql_connect($DB_Url,$DB_Name,$DB_pass);
        
        //判断
        if (!$con)
        {
            die('Could not connect: ' . mysql_error());
        }
        
        mysql_select_db($DB_Base,$con);
        
        return $con;
    }
    
    //关闭数据库连接
    function cls_con($cons){
        mysql_close($cons);
    }
?>