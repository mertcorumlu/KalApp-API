<?php


    if ($Auth->isLogged()) {
        echo '<script>window.location.replace("index.php")</script>';
    } else {


        ?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
            "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <!--suppress ALL -->
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
                    background: url("images/logo.png") no-repeat;
                    text-align: center;
                    margin-bottom: 30px;
                }

                .loginform {
                    position:relative;
                    width: 300px;
                    margin: auto;
                    padding: 10px;
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
                .loading{
                    display:none;
                    position:absolute;
                    width:100%;
                    height:100%;
                    background:rgba(255,255,255,0.7);
                    background-image:url("images/loading.gif");
                    background-position: center;
                    background-repeat: no-repeat;
                    z-index:999;
                    top:0;
                    left:0;

                }

            </style>

        </head>
        <body>
        <div class="login">
            <div class="logo"></div>
            <div id="status" style="display:none;" class=""></div>

            <div class="loginform">
                <div class="loading"></div>

                <form id="myForm" action="inc/loginapi.php" method="POST">
                    <p>
                        <label for="user_login">
                            <span>Kullanıcı Adı:</span> <br/>
                            <input type="text" id="user_login" name="email" autofocus/>
                        </label>
                    </p>

                    <p>
                        <label for="user_pass">
                            Şifre: <br/>
                            <input type="password" id="user_pass" name="pass"/>
                        </label>
                    </p>
                    <p>
                        <label id="label_remember" for="form_remember">
                            Beni Hatırla?
                            <input type="checkbox" id="form_remember" name="remember" value="1"/>
                        </label>

                    </p>
                    <p id="submit_button">
                        <button id="submit">Login</button>

                    </p>
                </form>


            </div>
        </div>


        <script>
            $("button#submit").click(function () {
                $("div.loading").show();

                if ($("#user_login").val() == "" || $("#user_pass").val() == ""){
                    $("div#status").addClass("red").html("Lütfen Kullanıcı Adı Ve Şifrenizi Girin").slideDown();
                    $("div.loading").hide();
                } else{
                    $.post($("#myForm").attr("action"),
                        $("#myForm :input").serializeArray(),
                        function (data) {
                            $("div#status").addClass("red").html(data).slideDown();
                            if (data.error == false) {

                                $("#myForm").slideDown();
                                $("div#status").addClass("green").html("Giriş Yapıldı. <br/> Yönlendiriliyorsunuz... ").slideDown();

                                setTimeout(function () {
                                    window.location.replace("?action=users");

                                }, 1000);

                            } else {
                                $("div#status").addClass("red").html(data.message).slideDown();

                            }
                            $("div.loading").hide();

                        });

                }

                $("#myForm").submit(function () {
                    return false;
                });

            });
        </script>
        </body>
        </html>

        <?php


}
    ?>