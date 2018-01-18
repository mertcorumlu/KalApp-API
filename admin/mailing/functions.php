<?php
/**
 * Created by PhpStorm.
 * User: MERT
 * Date: 27/02/2017
 * Time: 15:12
 */
include 'config.php';
function check_login(){
    if(!isset($_SESSION["login"])){
        header("location:login.php");
        exit;
    }

}
function check_db($a){
    if($a!==true){
        echo "Veritabanı Hatası";
        exit;

    }
}