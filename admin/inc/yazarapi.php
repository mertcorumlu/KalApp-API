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


    if(@$_GET["action"]=="addyazar" && @$_GET["start"]=="" && @$_GET["end"]==""){

        if($_POST){
            $ad=@$_POST["ad"];
            $url=@$_POST["img_url"];



            if (!empty($ad) && !empty($url)) {


                $prepare = $conn->prepare("INSERT INTO `yazarlar` SET
ad = :ad,
img_url = :url
");

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