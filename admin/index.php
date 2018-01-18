<?php
/**
 * Created by PhpStorm.
 * User: MERT
 * Date: 17/10/2017
 * Time: 11:11
 */
session_start();

include '../config.php';

if(@$_SESSION["admin"]==null){
   include 'pages/login.php';
   exit;
}

$page=@$_GET["page"];
if(!isset($page)){
    if($_GET["action"]==""){
        $_GET["action"]="messages";
    }
    include 'pages/list.php';
    exit;
}

//INCLUDE PAGE
include 'pages/'.$page.'.php';
