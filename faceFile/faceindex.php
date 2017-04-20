<?php

    $aa['api_key']          =   $_REQUEST['api_key'];

    $aa['$api_secret']      =   $_REQUEST['api_secret'];

    $aa['$image_file']      =   $_REQUEST['image_file'];


    var_dump($aa);

    echo json_encode($aa);
?>