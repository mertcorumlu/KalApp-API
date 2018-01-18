<?php
session_start();

    if (@$_SESSION["login"]==null) {
        echo '<script>window.location.replace("login.php")</script>';


    } else {

        if(!$_GET || @$_GET["auth"]==""){
            echo '<script>window.location.replace("login.php")</script>';

        }elseif(@$_GET["auth"]=="restriction"){

            $title="Restriction";
            $content='<div class="status red">Bu Sayfaya Erişim Yetkiniz Yoktur.<br/><a href="login.php?action=logout">Oturumu Kapat</a></div>';

        }


        ?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
            "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=0.7, user-scalable=no">
            <script src="js/jquery-3.1.1.min.js"></script>
            <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
            <title><?php echo @$title; ?></title>
            <style>
                body {
                    padding: 0;
                    margin: 0;
                    border: 0;
                    outline: 0;
                    background: #f1f1f1;
                }

                .login {
                    width: 400px;
                    margin: auto;
                    padding: 50px;
                }

                .logo {
                    width: 400px;
                    height: 145px;
                    background: url("images/logo.png") no-repeat;
                    text-align: center;
                    margin-bottom: 30px;
                }


                div.status {
                    padding: 15px;
                    color: white;
                    font-size: 17px;
                    border-radius: 5px;
                    text-align: center;
                    margin: 10px;
                }

                div.status.red {
                    background: #e86d66;
                }

                div.status.green {
                    background: #55874d;
                }

                div.status a {
                    color: rgb(73, 73, 67);
                    text-decoration: none;

                }


            </style>

        </head>
        <body>
        <div class="login">
            <div class="logo"></div>

            <?php echo @$content; ?>


        </div>

        </body>
        </html>

        <?php


}
?>