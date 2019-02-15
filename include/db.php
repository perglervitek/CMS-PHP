<?php
$db["db_host"] = "localhost";
$db["db_user"] ="root";
$db["db_pass"]="";
$db["db_name"]= "cms";

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