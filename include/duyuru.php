<?php
/**
 * Created by PhpStorm.
 * User: MERT
 * Date: 16/10/2017
 * Time: 22:02
 */

header("Content-Type:application/json");

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


    $query=$Class_Database->prepare("
        SELECT 
          messages.id,yazarlar.ad as `yazar`,yazarlar.img_url,messages.title,messages.content,messages.content_img,messages.date 
        FROM 
          `messages` 
        INNER JOIN 
          `yazarlar` 
        ON 
          yazarlar.id = messages.yazar_id 
        LIMIT ? OFFSET ?");


    if(!$query) {
        echo json_encode(
            array(
                "valid" => false,
                "error" => "SQL Error Code: ".$Class_Database->errorInfo()[1]
            )
        );

        exit;
    }

    $query->execute(array($count,$s));


    if($query->rowCount()==0){
        echo json_encode(array(array(
            "id"=>0,
            "title"=>null,
            "yazar"=>null,
            "img_url"=>null,
            "content"=>"Buraya Kadarmış Dostum :)",
            "content_img"=>null,
            "date"=>null

        )));
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
                "content_img"=>$fetch["content_img"],
                "date"=>tarih_hesapla($fetch["date"])

            );

            array_push($last,$data);

        }

        echo json_encode($last);



