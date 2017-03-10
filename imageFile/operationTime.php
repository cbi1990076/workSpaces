<?php
    error_reporting(E_ALL ^ E_DEPRECATED);

    include 'FunctionClass.php';

    $op_NumKey = array("operation","time");

    $op_NumValue = array('0',"");

    $op_WhereKey = array("id");

    $op_WhereValue = array('1');

    $op_table = "te_userOperation";

    $updRes = upd_sql($op_NumKey,$op_NumValue,$op_table,$op_WhereKey,$op_WhereValue);

    logRemark("interFace.txt","0");

    echo "OK";

?>