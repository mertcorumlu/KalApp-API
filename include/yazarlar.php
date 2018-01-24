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


    $query=$Class_Database->query("SELECT `ad` FROM `yazarlar` ");


    if(!$query){
        echo $Class_Database->errorInfo()[2];
        exit;
    }

    if($query->rowCount()==0){
        echo json_encode(array());
        exit;
    }


        $last=array();


        while($fetch=$query->fetch(PDO::FETCH_ASSOC)){
            $data= array(
                "yazar"=>$fetch["ad"],
            );

            array_push($last,$data);

        }

        echo json_encode($last);



    function tarih_hesapla($date){


    $unix=strtotime($date);
    $seconds=time()-$unix;

    if( $seconds < 60 /* Bir Dakikadan Küçükse */ ){

        return $seconds." Saniye Önce";

    }

    elseif ( $seconds < 60*60 /* Bir Saatten Küçükse */ ){

        return (int) ($seconds / 60)." Dakika Önce";

    }

    elseif ( $seconds < 60*60*24 /* Bir Günden Küçükse */ ){

        return (int) ($seconds / (60*60) )." Saat Önce";

    }

    elseif ( $seconds < 60*60*24*7 /* Bir Haftadan Küçükse */ ){

        return (int) ($seconds / (60*60*24) )." Gün Önce";

    }

    elseif ( $seconds < 60*60*24*30 /* Bir Aydan Küçükse */ ){

        return (int) ($seconds / (60*60*24*7) )." Hafta Önce";

    }


    elseif ( $seconds < 60*60*24*30*12 /* Bir Yıldan Küçükse */ ){

        return (int) ($seconds / (60*60*24*30) )." Ay Önce";

    }else{

        return (int) ($seconds / (60*60*24*30*12) )." Yıl Önce";

    }





}
