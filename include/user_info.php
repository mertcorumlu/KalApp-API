<?php
/**
 * Created by PhpStorm.
 * User: MERT
 * Date: 13/10/2017
 * Time: 19:41
 */


header("Content-Type:application/json");
$hash=get("hash");

if(!($hash)){
    header('HTTP/1.0 403 Forbidden');

    die('You are not allowed to access this page!');
}

$ans=$Auth->getSessionUID($hash);
if($ans==false){
    echo json_encode(array("valid"=>false));
    exit;
}

$query=$Class_Database->query("SELECT `okul_no`,`ad`,`soyad`,`telefon`,`email`,`dt` FROM `users` WHERE id=".$ans." LIMIT 1")->fetch(PDO::FETCH_ASSOC);

if(!$query) {
    echo json_encode(array("valid" => false, "error" => $Class_Database->errorInfo()[2]));
    exit;

}

$query["valid"]=true;
echo json_encode($query);
