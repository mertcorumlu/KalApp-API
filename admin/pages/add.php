

        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">


<!-- head -->
<?php require("inc/head.php"); ?>
<!-- /head -->

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">

            <?php require("inc/menu.php"); ?>
        </div>

          <!-- top navigation -->
          <?php require("inc/top-nav.php"); ?>
          <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">


            <div class="row">

                <?php

                if(@$_GET["action"]=="user"){

                ?>

              <div class="col-md-12 col-sm-12 col-xs-12">
                  <style>
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
                  <div class="loading"></div>
                <div class="x_panel">
                  <div class="x_content">

                      <div id="status" style="display:none;"></div>

                    <form class="form-horizontal form-label-left" id="myForm" method="POST" action="inc/adduserapi.php">

                      <span class="section">Yeni Kullancı Ekle</span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Okul No
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12"
                                       required data-validate-length-range="6"
                                       data-validate-words="2" name="okul_no"
                                       placeholder="Okul No" type="text" >
                            </div>
                        </div>



                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Sınıf <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="sinif" class="form-control" required>
                                    <option value="">Lütfen Seçin...</option>
                                    <option value="hz">Hazırlık</option>
                                    <option >9</option>
                                    <option >10</option>
                                    <option >11</option>
                                    <option >12</option>
                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Şube <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="sube" class="form-control" required>
                                    <option value="">Lütfen Seçin...</option>
                                    <option >A</option>
                                    <option >B</option>
                                    <option >C</option>
                                    <option >D</option>
                                    <option >E</option>
                                    <option >F</option>
                                    <option >G</option>
                                    <option >H</option>
                                    <option >I</option>
                                    <option >İ</option>
                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Ad
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12"
                                       name="ad"
                                       placeholder="Ad" type="text" >
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Soyad
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12"
                                       name="soyad"
                                       placeholder="Soyad" type="text" >
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                   for="password2">Email <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="email" class="form-control col-md-7 col-xs-12"
                                       required name="email" placeholder="Email" type="email" >
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Telefon
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12"
                                       required data-validate-length-range="6"
                                       data-validate-words="2" name="telefon"
                                       placeholder="Telefon" type="text" >
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                   for="password1">Yeni Şifre <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="password1" class="form-control col-md-7 col-xs-12"
                                       name="password"
                                       placeholder="Şifre" type="password" value="">
                            </div>
                        </div>



                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success">Submit</button>
                            <a href="javascript:history.back(-1);">Go Back</a>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
                    <script>
                        $("button#send").click(function () {
                            $("div.loading").show();

                            $.post($("#myForm").attr("action"),
                                $("#myForm :input").serializeArray(),
                                function (data) {
                                    if (data == false) {
                                        $("div#status").removeClass().addClass("green").html("Kullanıcı Başarıyla Eklendi").slideDown();

                                        setTimeout(function () {
                                            window.location.replace("?action=users");

                                        }, 2000);

                                    } else {
                                        $("div#status").addClass("red").html(data).slideDown();

                                    }
                                    $("div.loading").hide();
                                });

                            $("#myForm").submit(function () {
                                return false;
                            });



                        });
                    </script>

                <?php
                }
                elseif(@$_GET["action"]=="message"){

                    ?>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <style>
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
                        <div class="loading"></div>
                        <div class="x_panel">
                            <div class="x_content">

                                <div id="status" style="display:none;"></div>

                                <form class="form-horizontal form-label-left" id="myForm" method="POST" action="inc/messageapi.php?action=addmessage">

                                    <span class="section">Yeni Duyuru Ekle</span>



                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Başlık <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select id="title" class="form-control col-md-7 col-xs-12" required  name="yazar_id">
                                                <option value="">Lütfen Bir Yazar Seçin...</option>
                                                <?php
                                                $bul = $Class_Database->query("SELECT * FROM `yazarlar`");
                                                if (!$bul) {
                                                    echo $bul->errorInfo()[2];
                                                }
                                                
                                                while($fetch=$bul->fetch(PDO::FETCH_ASSOC)){
                                                    ?>
                                                    <option value="<?=$fetch["id"]?>"><?=$fetch["ad"]?></option>
                                                
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Başlık <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="title" class="form-control col-md-7 col-xs-12" required  name="title" placeholder="Başlık"  type="text">
                                        </div>
                                    </div>



                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password2">İçerik <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea id="content" class="form-control col-md-7 col-xs-12"  required  name="content" style="height:150px;" placeholder="İçerik" ></textarea>
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="notify">Bu Duyuru İçin Push Notification Gönder <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="checkbox" class="form-check-input" name="notify" id="notify">
                                        </div>
                                    </div>


                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <button id="send" type="submit" class="btn btn-success">Submit</button>
                                            <a href="javascript:history.back(-1);">Go Back</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <script>
                        $("button#send").click(function () {
                            $("div.loading").show();

                            $.post($("#myForm").attr("action"),
                                $("#myForm :input").serializeArray(),
                                function (data) {
                                    if (data == false) {
                                        $("div#status").removeClass().addClass("green").html("Duyuru Başarıyla Eklendi").slideDown();

                                        setTimeout(function () {
                                            /*window.location.replace("?action=messages");*/

                                        }, 2000);

                                    } else {
                                        $("div#status").addClass("red").html(data).slideDown();

                                    }
                                    $("div.loading").hide();
                                });

                            $("#myForm").submit(function () {
                                return false;
                            });



                        });
                    </script>

                    <?php

                }
                elseif(@$_GET["action"]=="yazar"){

                    ?>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <style>
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
                        <div class="loading"></div>
                        <div class="x_panel">
                            <div class="x_content">

                                <div id="status" style="display:none;"></div>

                                <form class="form-horizontal form-label-left" id="myForm" method="POST" action="inc/yazarapi.php?action=addyazar">

                                    <span class="section">Yeni Yazar Ekle</span>



                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Ad <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="title" class="form-control col-md-7 col-xs-12" required  name="ad" placeholder="Yazar Adı"  type="text">
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="img_url">Yazar Resmi <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="title" class="form-control col-md-7 col-xs-12" required  name="img_url" placeholder="Url"  type="text">
                                        </div>
                                    </div>




                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <button id="send" type="submit" class="btn btn-success">Submit</button>
                                            <a href="javascript:history.back(-1);">Go Back</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <script>
                        $("button#send").click(function () {
                            $("div.loading").show();

                            $.post($("#myForm").attr("action"),
                                $("#myForm :input").serializeArray(),
                                function (data) {
                                    if (data == false) {
                                        $("div#status").removeClass().addClass("green").html("Yazar Başarıyla Eklendi").slideDown();

                                        setTimeout(function () {
                                            /*window.location.replace("?action=messages");*/

                                        }, 2000);

                                    } else {
                                        $("div#status").addClass("red").html(data).slideDown();

                                    }
                                    $("div.loading").hide();
                                });

                            $("#myForm").submit(function () {
                                return false;
                            });



                        });
                    </script>

                    <?php

                }
                    elseif(@$_GET["action"]=="anket"){

                    ?>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <style>
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
                        <div class="loading"></div>
                        <div class="x_panel">
                            <div class="x_content">

                                <div id="status" style="display:none;"></div>

                                <form class="form-horizontal form-label-left" id="myForm" method="POST" action="inc/anketapi.php?action=anket_ekle">


                                    <span class="section">Yeni Anket Ekle
                                    </span>

                                    <div class="soru_group">

                                        <div class="item form-group">

                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Anket Başlığı
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input  class="form-control col-md-3 col-xs-12" required  name="anket_title" placeholder="Anket Başlığı"  type="text">
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <select  style="float:left" class="form-control col-md-3 col-xs-12" required name="anket_yazar" >
                                                    <option value="">Lütfen Seçin...</option>

                                                    <?php
                                                    error_reporting(E_ALL);

                                                    //include("inc/config.php");
                                                        $select = $Class_Database->prepare("SELECT * FROM `yazarlar`");

                                                    $select->execute(array());


                                                    if (!$select) {
                                                        echo $select->errorInfo()[2];
                                                        exit;
                                                    }

                                                    while($fetch=$select->fetch(PDO::FETCH_ASSOC)){
                                                        ?>
                                                        <option value="<?=$fetch["id"]?>"><?=$fetch["ad"]?></option>
                                                    <?php
                                                    }
                                                    ?>


                                                </select>
                                            </div>
                                            <div class="control-label col-md-3 col-sm-3 col-xs-12">
                                                <button id="soru_ekle" class="btn btn-success">Soru Ekle</button>
                                                <button id="soru_sil" class="btn btn-danger">Soru Sil</button>
                                            </div>

                                        </div>

                                    </div>



                                    <div class="ln_solid"></div>




                                    <div class="soru_group" data-index="0">

                                    <div class="item form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="name">1.Soru
                                        </label>
                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input  class="form-control col-md-3 col-xs-12" required  name="soru[]" placeholder="Soru"  type="text">
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <select  style="float:left" class="selector form-control col-md-3 col-xs-12" data-index="0" required name="secenek[]" >
                                                <option value="">Lütfen Seçin</option>
                                                <option value="0">Text-Radio</option>
                                                <option value="1">Image-Radio</option>
                                                <option value="2">Text-Checkbox</option>
                                                <option value="3">Image-Checkbox</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="divider"></div>
                                    </div>

                                    <div class="ln_solid"></div>
                                    <div class="form-group"  id="button-holder">
                                        <div class="col-md-6 col-md-offset-3">
                                            <button id="send" type="submit" class="btn btn-success">Submit</button>
                                            <a href="javascript:history.back(-1);">Go Back</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>


              <script src="js/anket.js?v=1"></script>
                    <script>
                        $("button#send").click(function () {
                            $("div.loading").show();

                            $.post($("#myForm").attr("action"),
                                $("#myForm :input").serializeArray(),
                                function (data) {
                                    if (data == false) {
                                        $("div#status").removeClass().addClass("green").html("Yazar Başarıyla Eklendi").slideDown();

                                        setTimeout(function () {
                                            /*window.location.replace("?action=messages");*/

                                        }, 2000);

                                    } else {
                                        $("div#status").addClass("red").html(data).slideDown();

                                    }
                                    $("div.loading").hide();
                                });

                            $("#myForm").submit(function () {
                                return false;
                            });



                        });
                    </script>

                    <?php

                }

                ?>


            </div>
          </div>
        </div>


        <!-- /page content -->

          <!-- footer content -->
          <?php require("inc/footer.php"); ?>
          <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>


    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>





  </body>
</html>
