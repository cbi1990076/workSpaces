<?php
    
    include 'FunctionClass.php';
    
    function sel_media($openid){
        
       if (isset($openid)!=true){
           
          logInfo("openid未设置!");
          
          return false;
       }
       
       $sel_table = "wx_media";
       
       $sel_whereKey = array("openid");
       
       $sel_whereValue = array($openid);
       
       $sel_res = sel_sql("", $sel_table, $sel_whereKey, $sel_whereValue);

       if ($sel_res!=false) {
           
           logInfo("sel_res = ".json_encode($sel_res));
            
           return $sel_res;
           
       }else {
           
           return false;
           
       }
       
    }
    
?>