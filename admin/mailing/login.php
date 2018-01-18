<?php
session_start();
/**
 * Created by PhpStorm.
 * User: MERT
 * Date: 27/02/2017
 * Time: 15:41
 */
if(isset($_SESSION["login"])){
    header("location:index.php");
    exit;
}else{


if($_POST){
  @$user=  $_POST["user"];
  @$pass=  $_POST["pass"];

    if($user=="admin" && "a1b2c3d4"){

        $_SESSION["login"]=array(
                "user"=>$user,
                "pass"=>true
        );

        if(isset($_SESSION["login"])){

            print json_encode(array("logged_in"=>"true"));

        }else{
            print json_encode(array("logged_in"=>"Giriş Yapılamadı.Lütfen Daha Sonra Tekrar Deneyiniz..."));

        }
    }else{
        print json_encode(array("logged_in"=>"Kullanıcı Adı Veya Şifre Hatalı."));

    }


    exit;
}else {


    ?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
            "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=0.7, user-scalable=no">
        <script src="js/jquery-3.1.1.min.js"></script>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>KallApp Admin Panel</title>
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
                text-align: center;
                margin-bottom: 30px;
            }

            .loginform {
                position: relative;
                width: 300px;
                margin: auto;
                padding: 15px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, .13);
                background: white;
            }

            input {
                outline: none;
            }

            #user_login, #user_pass {
                transition: 0.2s all;
                border: 1.5px solid #ddd;
                padding: 8px;
                font-size: 24px;
                width: 100%;
                border-radius: 2px;
                margin-top: 5px;
                background: #fbfbfb;
                box-shadow: inset 0 1px 2px rgba(0, 0, 0, .07);
            }

            #user_login:focus, #user_pass:focus {
                border-color: #5b9dd9;
                box-shadow: 0 0 2px rgba(30, 140, 190, .8)
            }

            #user_login {
                color: #43484b
            }

            #user_pass {
                color: #43484b;
            }

            #submit {
                transition: 0.2s all;
                width: 80px;
                height: 35px;
                border: 0;
                color: white;
                background: #0085ba;
                cursor: pointer;
                border-radius: 5px;
                outline: 0
            }

            #submit:hover {
                background: #0085b0
            }

            #submit:active {
                background: #016890
            }

            #form_remember {
                float: left;
                width: 15px;
                height: 15px;
            }

            #label_remember {
                font-size: 16px;
                margin-top: 10px;
                cursor: pointer
            }

            div#status {
                padding: 15px;
                color: white;
                font-size: 17px;
                border-radius: 5px;
                text-align: center;
                margin: 10px;
            }

            div#status.red {
                background: #e86d66;
            }

            div#status.green {
                background: #55874d;
            }

            #submit_button {
                text-align: right
            }

            #myForm {
                width: 230px;
                margin: auto
            }

            .loading {
                display: none;
                position: absolute;
                width: 100%;
                height: 100%;
                background: rgba(255, 255, 255, 0.7);
                background-image: url("images/loading.gif");
                background-position: center;
                background-repeat: no-repeat;
                z-index: 999;
                top: 0;
                left: 0;

            }

            .statusholder {
                width: 100%;
                height: 75px
            }

        </style>

    </head>
    <body>
    <div class="login">
        <div class="logo"></div>
        <div class="statusholder">
            <div id="status" style="display:none;" class=""></div>
        </div>


        <div class="loginform">
            <div class="loading"></div>

            <form id="myForm" action="" method="POST">
                <p>
                    <label for="user_login">
                        <span>Kullanıcı Adı:</span> <br/>
                        <input type="text" id="user_login" name="user" autofocus/>
                    </label>
                </p>

                <p>
                    <label for="user_pass">
                        Şifre: <br/>
                        <input type="password" id="user_pass" name="pass"/>
                    </label>
                </p>

                <p id="submit_button">
                    <button id="submit">Login</button>

                </p>
            </form>


        </div>
    </div>
    <script>
        $("form").on("submit", function (e) {
            e.preventDefault();
            $("div.loading").show();

            if ($("#user_login").val() == "" || $("#user_pass").val() == "") {
                $("div#status").addClass("red").html("Lütfen Kullanıcı Adı Ve Şifrenizi Girin").slideDown();
                $("div.loading").hide();
            } else {
                $.post(
                    "login.php",
                    $("form :input").serializeArray(),
                    function (data) {
                        var deneme = jQuery.parseJSON(data);
                        if (deneme.logged_in == "true") {
                            $("#myForm").slideDown();
                            $("div#status").addClass("green").html("Giriş Yapıldı. <br/> Yönlendiriliyorsunuz... ").slideDown();

                            setTimeout(function () {
                                window.location.href = "index.php";

                            }, 500)

                        } else {
                            $("div#status").addClass("red").html(deneme.logged_in).slideDown();
                            $("div.loading").hide();
                        }

                    }
                );
            }
        });

    </script>
    </body>
    </html>


    </body>
    </html>
    <?php
}
} ?>