<?php
/**
 * Created by PhpStorm.
 * User: MERT
 * Date: 16/10/2017
 * Time: 22:02
 */

header("Content-Type:application/json");

$hash=get("hash");
$action=get("do");
$q=mb_strtolower(get("q"));
$s=get("s");
$count=get("f")-$s;


if(empty($hash) ||  empty($action) || empty($q) || empty(get("f")) ){
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


    if($action=="duyuru"){

        $query=$Class_Database->prepare(
            "SELECT
              messages.id,
              yazarlar.ad AS `yazar`,
              yazarlar.img_url,
              messages.title,
              messages.content,
              messages.content_img,
              messages.date
            FROM
              `messages`
            INNER JOIN
              `yazarlar`
            ON
              yazarlar.id = messages.yazar_id
            WHERE
              messages.content LIKE CONCAT('%',?,'%') OR 
              messages.title LIKE CONCAT('%',?,'%') OR 
              yazarlar.ad LIKE CONCAT('%',?,'%') 
              LIMIT ? OFFSET ?
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

        $query->execute(array($q,$q,$q,$count,$s));

        if($query->rowCount()==0){
            echo json_encode(array(array(
                "id"=>0,
                "title"=>null,
                "yazar"=>null,
                "img_url"=>null,
                "content"=>"'".get("q")."' İçin Bir Şey Bulunamadı.'",
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



    }
    else if($action=="anket"){


        $query=$Class_Database->prepare(
            "SELECT
              anket.id,
              anket.title,
              yazarlar.ad AS `yazar`,
              yazarlar.img_url,
              anket.content,
              anket.date
            FROM
              `anket`
            INNER JOIN
              `yazarlar`
            ON
              yazarlar.id = anket.author_id
              WHERE 
               yazarlar.ad LIKE CONCAT('%',?,'%')
            LIMIT ? OFFSET ?
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

        $query->execute(array($q,$count,$s));

        if($query->rowCount()==0){
            echo json_encode(array(array(
                "id"=>0,
                "title"=>"'".get("q")."' İçin Bir Şey Bulunamadı.'",
                "yazar"=>null,
                "voted"=>0,
                "img_url"=>null,
                "date"=>null

            )));
            exit;
        }


        $last=array();


        while($fetch=$query->fetch(PDO::FETCH_ASSOC)){
            $query1=$Class_Database->prepare("SELECT * FROM `anket_sonuc` WHERE `anket_id`=? && `user_id`=? ");


            if(!$query1) {
                echo json_encode(
                    array(
                        "valid" => false,
                        "error" => "SQL Error Code: ".$Class_Database->errorInfo()[1]
                    )
                );

                exit;
            }

            $query1->execute(array($fetch["id"],$ans));

                        $voted=0;

                        if($query1->rowCount()>0) {
                            $voted = 1;
                        }

                        $data= array(
                            "id"=>$fetch["id"],
                            "title"=>$fetch["title"],
                            "yazar"=>$fetch["yazar"],
                            "voted"=>$voted,
                            "img_url"=>$fetch["img_url"],
                            "date"=>$fetch["date"]

                        );

            array_push($last,$data);


        }

        echo json_encode($last);



    }

    else{
        header('HTTP/1.0 403 Forbidden');

        die('You are not allowed to access this page!');
    }

