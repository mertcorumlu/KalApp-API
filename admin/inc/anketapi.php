<?php
session_start();
//error_reporting(0);

if(@$_SESSION["admin"]==null){
    echo 'Not Logged In';
    exit;
}


if($_GET){


    include("../../config.php");

    $conn = $Class_Database;
    $conn->query("SET NAMES utf8");


    if(@$_GET["action"]=="anket_ekle" && @$_GET["start"]=="" && @$_GET["end"]==""){

        if($_POST){


            $title=@$_POST["anket_title"];
            $yazar=@$_POST["anket_yazar"];
            $soru=@$_POST["soru"];
            $secenek=@$_POST["secenek"];
            $post=@$_POST;



            if (!empty($title) /*&& !empty($yazar)*/ && !empty($soru) && !empty($secenek) ) {

                $content=array();

                foreach ($soru as $key=>$value){

                    switch ($secenek[$key]){
                        case 0:
                            $soru_type="text_radio";
                            break;

                        case 1:
                            $soru_type="image_radio";
                            break;

                        case 2:
                            $soru_type="text_checkbox";
                            break;

                        case 3:
                            $soru_type="image_checkbox";
                            break;

                        default:
                            $soru_type="text_checkbox";
                            break;
                    }

                    $content[$key]=array(
                        "soru"=>$value,
                        "type"=>$soru_type
                    );

                    $options=array();
                    foreach ($post[$key] as $key1=>$value1){

                        switch ($secenek[$key]){
                            case 0:
                                $sik_type="text";
                                break;

                            case 1:
                                $sik_type="image";
                                break;

                            case 2:
                                $sik_type="text";
                                break;

                            case 3:
                                $sik_type="image";
                                break;

                            default:
                                $soru_type="text";
                                break;
                        }

                        $options[$key1]=array(
                            "type"=>$sik_type,
                            "opt_content"=>$value1
                        );
                    }
                    $content[$key]["options"]=$options;

                }


                $prepare = $conn->prepare("INSERT INTO `anket` SET
              title = :title,
              author_id = :yazar,
              content= :content
              ");

                $exec = $prepare->execute(array(
                    "title" => $title,
                    "yazar" => $yazar,
                    "content"=>json_encode($content)
                ));


                if ($exec) {
                    return false;
                } else {

                    echo $prepare->errorInfo()[2];

                }



            } else {
                echo "Boş Alan Bırakılamaz";
            }

        }



    }
    elseif(@$_GET["action"]=="updateyazar" && @$_GET["start"]=="" && @$_GET["end"]==""){

        if ($_POST) {
            $ad=@$_POST["ad"];
            $url = @$_POST["img_url"];
            $id=@$_POST["id"];




            if (!empty($ad) && !empty($url) && !empty($id)) {


                $prepare = $conn->prepare("UPDATE `yazarlar` SET
ad = :ad,
img_url = :url WHERE id='{$id}' ");

                $exec = $prepare->execute(array(
                    "ad" => $ad,
                    "url" => $url
                ));

                if ($exec) {
                    return false;
                } else {

                    echo $prepare->errorInfo()[2];

                }



            } else {
                echo "Boş Alan Bırakılamaz";
            }





        }



    }
    elseif ($_GET["action"]=="delete" && $_GET["id"]!=""){

        $id=$_GET["id"];
        $prepare = $Class_Database->prepare("DELETE FROM `yazarlar`WHERE id='{$id}' ");

        $exec_array=array(
        );

        $exec = $prepare->execute($exec_array);

        if ($exec) {
            return false;
        } else {
            echo $prepare->errorInfo()[2];
        }
    }










}






?>