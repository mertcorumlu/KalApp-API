<?php
/**
 * Created by PhpStorm.
 * User: MERT
 * Date: 13/10/2017
 * Time: 18:44
 */

error_reporting(0);

$get=get("action");
$includepath="";


switch($get){

    case "login":
        $includepath= 'include/login.php';
        break;

    case "auth":
        $includepath= 'include/auth.php';
        break;

    case "user_info":
        $includepath= 'include/user_info.php';
        break;

    case "anket":
        $includepath= 'include/anket/index.php';
        break;

    case "duyuru":
        $includepath= 'include/duyuru.php';
        break;

    default:
        header('HTTP/1.0 403 Forbidden');

        die('You are not allowed to access this page!');

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

