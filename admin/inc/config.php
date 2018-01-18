<?php
/**
 * Created by PhpStorm.
 * User: MERT
 * Date: 11/12/2016
 * Time: 13:33
 */


/* DATABASE*/
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="appadmin";

/* DATABSE */
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


?>
