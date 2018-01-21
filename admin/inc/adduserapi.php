<?php

session_start();
//error_reporting(0);

if(@$_SESSION["admin"]==null){
    header('HTTP/1.0 403 Forbidden');

    die('You are not allowed to access this page!');
}


if($_GET){

    if($_GET["action"]=="update"){

        if ($_POST) {
            $id=post("id");
            $okul_no=post("okul_no");
            $class=post("sinif")."-".post("sube");
            $ad=post("ad");
            $soyad=post("soyad");
            $email=post("email");
            $tel=post("telefon");
            $password="";
            $prep_string="";
            if($_POST["password"]!==""){
                $password=post("password");
                $prep_string=",password= :pass";
            }




            include '../../config.php';


                        $prepare = $Class_Database->prepare("UPDATE users SET
okul_no = :okulno,
class = :class,
ad= :ad,
soyad= :soyad,
email= :email, 
telefon= :telefon
".@$prep_string." 
 WHERE id='{$id}' ");


                            $exec_array=array(
                                "okulno" => $okul_no,
                                "class" => $class,
                                "ad" => $ad,
                                "soyad" => $soyad,
                                "email" => $email,
                                "telefon" => $tel
                            );

                            if($password!==""){
                                $exec_array["pass"]=$Auth->getHash($password);
                            }

                        $exec = $prepare->execute($exec_array);



                        if ($exec) {
                           return false;
                        } else {
                            echo $prepare->errorInfo()[2];
                        }

        }

    }
    elseif($_GET["action"]=="delete" && $_GET["id"]!=""){
        include '../../config.php';

                    $id=$_GET["id"];
                    $prepare = $Class_Database->prepare("DELETE FROM `users`WHERE id='{$id}' ");

                    $exec_array=array(
                    );

                    $exec = $prepare->execute($exec_array);

                    if ($exec) {
                        return false;
                    } else {
                        echo $prepare->errorInfo()[2];
                    }
                }


}else {


    if ($_POST) {
        $okul_no=post("okul_no");
        $class=post("sinif")."-".post("sube");
        $ad=post("ad");
        $soyad=post("soyad");
        $email=post("email");
        $tel=post("telefon");
        $password=post("password");
        $mail=null;


        include("../../config.php");

       $a= $Auth->register($email,$password,$password,array("okul_no"=>$okul_no,"class"=>$class,"ad"=>$ad,"soyad"=>$soyad,"telefon"=>$tel),$mail);

       if($a["error"]==false){
           return false;
       }else{
           echo $a["message"];
       }






    }

}


function post($name){
    if(isset($_POST[$name])){

        if (is_array($_POST[$name])){
            return array_map(function($item){
                return filterUrl($item);
            }, $_POST[$name]);
        }

        return filterUrl($_POST[$name]);

    }
    return false;
}
function filterUrl($a){
    return htmlspecialchars(trim($a));
}


?>
