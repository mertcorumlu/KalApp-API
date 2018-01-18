<?php
/**
 * Created by PhpStorm.
 * User: MERT
 * Date: 13/10/2017
 * Time: 19:36
 */

//header("Content-Type:application/json");

$hash=get("hash");

if(!($hash)){
    header('HTTP/1.0 403 Forbidden');

    die('You are not allowed to access this page!');
}

//echo json_encode(array("valid"=>$Auth->checkSession($hash)));

print_r($Auth->register("mertcorumlu55@gmail.com","a1b2c3d4.","a1b2c3d4.",array("okul_no"=>"9012")));