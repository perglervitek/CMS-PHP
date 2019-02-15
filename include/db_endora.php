<?php
$db["db_host"] = "localhost";
$db["db_user"] ="vitecek";
$db["db_pass"]="/6i1Wqjs3";
$db["db_name"]= "cmsko";

foreach($db as $key => $value){
    define(strtoupper($key),$value);
}

$connection = mysqli_connect(DB_HOST, DB_USER,DB_PASS,DB_NAME);
if(!$connection){
    die("Chyba spojeni" . mysqli_error());
}else{
    //echo "We are connected";
}
mysqli_set_charset($connection,"utf8");