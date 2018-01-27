<?php
/**
 * Created by PhpStorm.
 * User: MERT
 * Date: 16/10/2017
 * Time: 22:02
 */

header("Content-Type:application/json");

$hash=get("hash");
if(empty($hash)){
    header('HTTP/1.0 403 Forbidden');

    die('You are not allowed to access this page!');
}

    /*
     * Kullanıcı Hash Kontrol Et
     */

    $ans=$Auth->getSessionUID($hash);
    if($ans==false){
        header('HTTP/1.0 403 Forbidden');

        die('You are not allowed to access this page!');
    }


    $query=$Class_Database->prepare("SELECT `ad`,`img_url` FROM `yazarlar` ");


        if(!$query) {
            echo json_encode(
                array(
                    "valid" => false,
                    "error" => "SQL Error Code: ".$Class_Database->errorInfo()[1]
                )
            );

            exit;
        }
        $query->execute();

    if($query->rowCount()==0){
        echo json_encode(array());
        exit;
    }


        $last=array();


        while($fetch=$query->fetch(PDO::FETCH_ASSOC)){
            $data= array(
                "yazar"=>$fetch["ad"],
                "img_url"=>$fetch["img_url"]
            );

            array_push($last,$data);

        }

        echo json_encode($last);
