<?php
/**
 * Created by PhpStorm.
 * User: MERT
 * Date: 19/10/2017
 * Time: 18:44
 */
$db_server="localhost";
$db_name="kalapp";
$db_user="root";
$db_pass="";
$db_charset="UTF8";



function __autoload($name){
    $name=str_replace(array("\\"),array("/"),$name);
    include 'include/'.$name.".php";
}

try{
    $Class_Database=new PDO("mysql:host=" . $db_server .
        ";dbname=" . $db_name .
        ";charset=" . $db_charset . "",
        $db_user,
        $db_pass);
}catch(PDOException $e){
    echo $e->getMessage();
    exit;
}



$Auth_Config=new PHPAuth\Config($Class_Database);
$Auth=new PHPAuth\Auth($Class_Database,$Auth_Config);
