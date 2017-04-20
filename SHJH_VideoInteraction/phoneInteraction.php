<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    header('Content-type: application/json; charset=UTF-8');
    
    //接收参数
    $num = $_REQUEST['num'];
    
    //创建文件
    $myfile = fopen("readMe.txt", "w") or die("Unable to open file!");
    
    //判断是否收到
    if($num!="" && $num!=null){
        
        //解析串
        $num = json_decode($num);
        
        //判断阶段
        switch ($num){
            case 0:
                $type="0";
                break;
            case 1:
                $type="1";
                break;
            case 2:
                $type="2";
                break;
            case 3:
                $type="3";
                break;
        }
        
        //写入文件
        fwrite($myfile, $type);
        
        //关闭文件流
        fclose($myfile);
        
        if ($type==3){
            //等待10秒
            sleep(20);
            
            //创建文件
            $myfiles = fopen("readMe.txt", "w") or die("Unable to open file!");
            
            $type=0;
            
            //写入文件0
            fwrite($myfiles, $type);
            
            //关闭文件流
            fclose($myfiles);
        }
        
        //返回成功
        $num = array(
            'type'=>"1",
            'info'=>"Success"
        );
        
    }else {
        //返回失败
        $num = array(
            'type' => "2",
            'info' => "fail"
        );
    }
    
    //输出
    echo json_encode($num);
?>