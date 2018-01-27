<?php
/**
 * Created by PhpStorm.
 * User: MERT
 * Date: 13/10/2017
 * Time: 19:41
 */

$hash=get("hash");

if(!($hash)){
    header('HTTP/1.0 403 Forbidden');

    die('You are not allowed to access this page!');
}

//header("Content-Type:application/json");

$ans=$Auth->getSessionUID($hash);
if($ans==false){
    echo json_encode(array("valid"=>false,"message"=>"This Hash Is Not Valid."));
    exit;
}

    $query=$Class_Database->prepare("
                                   SELECT 
                                    `okul_no`,`ad`,`soyad`,`profile_img` as `img_url`,`telefon`,`email`,`dt` 
                                   FROM 
                                    `users` 
                                    WHERE 
                                      id=?
                                    LIMIT 1
                                      ");

    if(!$query) {
        echo json_encode(
            array(
                "valid" => false,
                "error" => "SQL Error Code: ".$Class_Database->errorInfo()[1]
                )
        );

        exit;
    }

    $query->execute(array($ans));
    $query=$query->fetch(PDO::FETCH_ASSOC);

    $query["valid"]=true;
    echo json_encode($query);
