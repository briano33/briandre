<?php
$db_host='localhost';
$db_user='root';
$db_password='';
$db_name='brian';


if(!($connect=mysqli_connect($db_host,$db_user,$db_password,$db_name))){
    die();
}else{
    return $connect;
}