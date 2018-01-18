<?php
/**
 * Created by PhpStorm.
 * User: MERT
 * Date: 17/07/2017
 * Time: 13:44
 */

session_start();
error_reporting(0);
header("Content-type:application/json");

$return=array();

if(!$_POST || $_SESSION["admin"]!=null){
    $return["error"]=true;
    $return["message"]="No Data Post Or Logged In";
    echo json_encode($return);
    exit;
}



$email=post("email");
$password=post("pass");
$remember=0;




if($email=="admin" && $password=="a1b2c3d4"){

    $_SESSION["admin"]="true";
    $return["error"]=false;
    echo json_encode($return);
    exit;


}else{
    $return["error"]=true;
    $return["message"]="Kullanıcı Adı veya Şifre Hatalı";
    echo json_encode($return);
    exit;
}


function post($name){
    if(isset($_POST[$name])){

        if (is_array($_POST[$name])){
            return array_map(function($item){
                return filterUrl($item);
            }, $_POST[$name]);
        }

        return filterUrl($_POST[$name]);

    }
    return false;
}
function filterUrl($a){
    return htmlspecialchars(trim($a));
}









