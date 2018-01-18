<?php
/**
 * Created by PhpStorm.
 * User: MERT
 * Date: 13/10/2017
 * Time: 18:50
 */
 


header("Content-Type:application/json");

$okulno=get("okul_no");
$pass=get("pass");
$cms_token=get("fcms_token");


if(empty($okulno) || empty($pass) || empty($cms_token)){
    header('HTTP/1.0 403 Forbidden');

    die('You are not allowed to access this page!');
}
echo json_encode($Auth->login_okulno($okulno,$pass,1,$cms_token));
