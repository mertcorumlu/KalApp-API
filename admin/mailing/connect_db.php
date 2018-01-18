<?php
/**
 * Created by PhpStorm.
 * User: MERT
 * Date: 27/02/2017
 * Time: 15:12
 */
$db=new PDO("mysql:host={$config_db["host"]};dbname={$config_db["dbname"]};charset={$config_db["charset"]}","{$config_db["user"]}","{$config_db["pass"]}");
    if($db){
        $connected=true;
}
