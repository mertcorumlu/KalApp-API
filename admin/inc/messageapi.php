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


        if(@$_GET["action"]=="addmessage" && @$_GET["start"]=="" && @$_GET["end"]==""){

            if($_POST){
                $title=ucwords(trim(@$_POST["title"]));
                $content =@$_POST["content"];
                $notify=@$_POST["notify"];
                $yazar_id = @$_POST["yazar_id"];



                if (!empty($title) && !empty($content) && !empty($yazar_id)) {


                    $prepare = $conn->prepare("INSERT INTO `messages` SET
yazar_id = :yazar_id,
title = :title,
content = :content
");
/*
                    $exec = $prepare->execute(array(
                        "yazar_id" => $yazar_id,
                        "title" => $title,
                        "content" => $content
                    ));*/
$exec=true;


                    if ($exec) {
                        if($notify){


                            define( 'API_ACCESS_KEY', 'AAAAZ26SiTA:APA91bHb5JXD70bTZo_NU0jfonPA9KVNZfwAYntjAH40KMNMCRrBFetExpt2w3V_j-HrBwkmjdgurs27dIe7Eg7T75vqDgbn3w7Ri4q8xy3hQZzPItHg8KvpxT5XuO-zGHBFIqqo5TtD' );

                            $bul = $Class_Database->query("SELECT `fcms_token` FROM `sessions`");
                            if (!$bul) {

                                echo $Class_Database->errorInfo()[2];
                                exit;

                            }
                            $registrationIds=array();
                                while($data=$bul->fetch(PDO::FETCH_ASSOC)){
                                    array_push($registrationIds,$data["fcms_token"]);
                                }

                            $msg = array
                            (
                                'body' 	=> $content,
                                'title'	=> $title
                            );
                            $fields = array
                            (
                                'registration_ids'		=> $registrationIds,
                                'notification'	=> $msg
                            );


                            $headers = array
                            (
                                'Authorization: key=' . API_ACCESS_KEY,
                                'Content-Type: application/json'
                            );

                            $ch = curl_init();
                            curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                            curl_setopt( $ch,CURLOPT_POST, true );
                            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                            $result = curl_exec($ch );
                            curl_close( $ch );
#Echo Result Of FireBase Server

                            $result=json_decode($result,true);
                            if($result["success"]>0){
                                echo print_r($result);
                            }else{
                                print_r($result);
                                echo 'Duyuru Veritabanına Eklendi Ancak Push Notification Gönderilemedi.';
                            }




                        }else{
                            return false;
                        }





                    } else {

                        echo $prepare->errorInfo()[2];

                    }



                } else {
                    echo "Boş Alan Bırakılamaz";
                }






            }



        }
        elseif(@$_GET["action"]=="updatemessage" && @$_GET["start"]=="" && @$_GET["end"]==""){

            if ($_POST) {
                $content=@$_POST["content"];
                $title = ucwords(trim(@$_POST["title"]));
                $id=@$_POST["id"];




                    if (!empty($title) && !empty($content)) {


                        $prepare = $conn->prepare("UPDATE messages SET
title = :title,
content = :content WHERE id='{$id}' ");

                        $exec = $prepare->execute(array(
                            "title" => $title,
                            "content" => $content
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
            $prepare = $Class_Database->prepare("DELETE FROM `messages`WHERE id='{$id}' ");

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