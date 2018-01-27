<?php
/**
 * Created by PhpStorm.
 * User: MERT
 * Date: 13/10/2017
 * Time: 18:44
 */

//error_reporting(0);

$get=get("action");
$includepath="";


switch($get){

    case "login":
        //Security Checked
        $includepath= 'include/login.php';
        break;

    case "user_info":
        //Security Checked
        $includepath= 'include/user_info.php';
        break;

    case "anket":
        //Security Checked
        $includepath= 'include/anket/index.php';
        break;

    case "duyuru":
        //Security Checked
        $includepath= 'include/duyuru.php';
        break;

    case "search":
        //Security Checked
        $includepath= 'include/search.php';
        break;

    case "yazarlar":
        //Security Checked
        $includepath= 'include/yazarlar.php';
        break;

    default:
        header('HTTP/1.0 403 Forbidden');

        die("You are not allowed to access this page!");

        break;

}

include 'config.php';




include ($includepath);

function filterUrl($a){
    return htmlspecialchars(trim($a));
}
function get($name){
    if(isset($_GET[$name])){

        if (is_array($_GET[$name])){
            return array_map(function($item){
                return filterUrl($item);
            }, $_GET[$name]);
        }

        return filterUrl($_GET[$name]);

    }
    return false;
}
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


