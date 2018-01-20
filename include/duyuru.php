<?php
/**
 * Created by PhpStorm.
 * User: MERT
 * Date: 16/10/2017
 * Time: 22:02
 */

header("Content-Type:application/json");
sleep(10);

$hash=get("hash");
$s=get("s");
$count=get("f")-$s;

if(empty($hash) ||  empty(get("f"))){
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


    $query=$Class_Database->query("SELECT messages.id,yazarlar.ad as `yazar`,yazarlar.img_url,messages.title,messages.content,messages.date FROM `messages` INNER JOIN `yazarlar` ON yazarlar.id = messages.yazar_id LIMIT {$count} OFFSET {$s}");


    if(!$query){
        echo $Class_Database->errorInfo()[2];
        exit;
    }

    if($query->rowCount()==0){
        echo 'No Such Message!';
        exit;
    }


        $last=array();


        while($fetch=$query->fetch(PDO::FETCH_ASSOC)){
            $data= array(
                "id"=>$fetch["id"],
                "title"=>$fetch["title"],
                "yazar"=>$fetch["yazar"],
                "img_url"=>$fetch["img_url"],
                "content"=>$fetch["content"],
                "date"=>$fetch["date"]

            );

            array_push($last,$data);

        }

        echo json_encode($last);
