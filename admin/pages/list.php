
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">


    <!-- head -->
    <?php
    if(@$_SESSION["admin"]==null){
        header('HTTP/1.0 403 Forbidden');

        die('You are not allowed to access this page!');
    }
    require("inc/head.php"); ?>
    <!-- Datatables -->
    <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
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
                        if(@$_GET["action"]=="users" && @$_GET["do"]=="") {




                                    $bul = $Class_Database->query("SELECT * FROM users");
                                    if (!$bul) {

                                        echo $Class_Database->errorInfo()[2];

                                    }



                                ?>




                            <div class="col-md-12 col-sm-12 col-xs-12">

                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Kullanıcılar</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <table id="datatable-responsive"
                                               class="table table-striped table-bordered dt-responsive nowrap"
                                               cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Sınıf</th>
                                                <th>Okul No</th>
                                                <th>Ad Soyad</th>
                                                <th>Tel. No</th>
                                                <th>Email</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            while ($data = $bul->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $data["id"]; ?></td>
                                                    <td><?php echo strtoupper($data["class"]); ?></td>
                                                    <td><?php echo $data["okul_no"]; ?></td>
                                                    <td><?php echo $data["ad"]." ".$data["soyad"]; ?></td>
                                                    <td><?php echo $data["telefon"]; ?></td>
                                                    <td><?php echo $data["email"]; ?></td>
                                                    <td><?php echo $data["dt"]; ?></td>
                                                    <td><a style="color:#55874d" href="?action=users&do=update&id=<?php echo $data["id"]; ?>">Düzenle</a></td>

                                                </tr>
                                                <?php
                                            }
                                            ?>


                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                        elseif($_GET["action"]=="users" && $_GET["do"]=="update" && $_GET["id"]!==""){

                            $id= $_GET["id"];

                            $bul = $Class_Database->prepare("SELECT * FROM users WHERE id=? ");

                            if (!$bul) {
                                echo $Class_Database->errorInfo()[2];
                            }

                            $bul->execute(array($id));

                            if($bul->rowCount()>0) {

                            $data=$bul->fetch(PDO::FETCH_ASSOC);

                            $class=explode("-",$data["class"]);
                            $sinif=@$class[0];
                            $sube=@$class[1];




                            ?>


                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <style>
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
                               </style>
                               <div class="loading"></div>
                               <div class="x_panel">
                                   <div class="x_content">

                                       <div id="status" style="display:none;"></div>

                                       <form class="form-horizontal form-label-left" id="myForm" method="POST"
                                             action="inc/adduserapi.php?action=update">

                                           <input type="hidden" value="<?php echo $data["id"]; ?>" name="id">

                                           <span class="section">Kullanıcı Düzenle</span>


                                           <div class="item form-group">
                                               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Okul No
                                                   <span class="required">*</span>
                                               </label>
                                               <div class="col-md-6 col-sm-6 col-xs-12">
                                                   <input id="name" class="form-control col-md-7 col-xs-12"
                                                          required data-validate-length-range="6"
                                                          data-validate-words="2" name="okul_no"
                                                          placeholder="Okul No" type="text" value="<?php echo $data["okul_no"]; ?>">
                                               </div>
                                           </div>



                                           <div class="item form-group">
                                               <label class="control-label col-md-3 col-sm-3 col-xs-12">Sınıf <span
                                                           class="required">*</span>
                                               </label>
                                               <div class="col-md-6 col-sm-6 col-xs-12">
                                                   <select name="sinif" class="form-control" required>
                                                       <option value="">Lütfen Seçin...</option>
                                                       <option <?php if($sinif=="hz"){echo "selected";} ?> value="hz">Hazırlık</option>
                                                       <option <?php if($sinif=="9"){echo "selected";} ?>>9</option>
                                                       <option <?php if($sinif=="10"){echo "selected";} ?>>10</option>
                                                       <option <?php if($sinif=="11"){echo "selected";} ?>>11</option>
                                                       <option <?php if($sinif=="12"){echo "selected";} ?>>12</option>
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
                                                       <option <?php if($sube=="A"){echo "selected";} ?>>A</option>
                                                       <option <?php if($sube=="B"){echo "selected";} ?>>B</option>
                                                       <option <?php if($sube=="C"){echo "selected";} ?>>C</option>
                                                       <option <?php if($sube=="D"){echo "selected";} ?>>D</option>
                                                       <option <?php if($sube=="E"){echo "selected";} ?>>E</option>
                                                       <option <?php if($sube=="F"){echo "selected";} ?>>F</option>
                                                       <option <?php if($sube=="G"){echo "selected";} ?>>G</option>
                                                       <option <?php if($sube=="H"){echo "selected";} ?>>H</option>
                                                       <option <?php if($sube=="I"){echo "selected";} ?>>I</option>
                                                       <option <?php if($sube=="İ"){echo "selected";} ?>>İ</option>
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
                                                          placeholder="Ad" type="text" value="<?php echo $data["ad"]; ?>">
                                               </div>
                                           </div>

                                           <div class="item form-group">
                                               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Soyad
                                                   <span class="required">*</span>
                                               </label>
                                               <div class="col-md-6 col-sm-6 col-xs-12">
                                                   <input id="name" class="form-control col-md-7 col-xs-12"
                                                          name="soyad"
                                                          placeholder="Soyad" type="text" value="<?php echo $data["soyad"]; ?>">
                                               </div>
                                           </div>

                                           <div class="item form-group">
                                               <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                      for="password2">Email <span class="required">*</span>
                                               </label>
                                               <div class="col-md-6 col-sm-6 col-xs-12">
                                                   <input id="email" class="form-control col-md-7 col-xs-12"
                                                          required name="email" placeholder="Email" type="email" value="<?php echo $data["email"]; ?>">
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
                                                          placeholder="Telefon" type="text" value="<?php echo $data["telefon"]; ?>">
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
                                                   <button id="send" type="submit" class="btn btn-success">Submit
                                                   </button>

                                                   <button id="del" class="btn btn-danger">Kullanıcıyı Sil
                                                   </button>
                                                   <a href="javascript:history.back(-1);">Go Back</a>
                                               </div>
                                           </div>
                                       </form>
                                   </div>
                               </div>
                           </div>


                           <script>
                               $("button#del").click(function (e) {
                                   e.preventDefault();

                                   if(confirm("Bu Kullanıcıyı Silmek İstediğiniden Emin Misiniz?")){
                                       $.get(
                                           "inc/adduserapi.php?action=delete&id=<?=$_GET["id"]?>",
                                           function (data) {
                                               if (data == false) {
                                                   alert("Kulllanıcı Başarıyla Silindi");
                                                   window.location.replace("?action=users")



                                               } else {
                                                   $("div#status").addClass("red").html(data).slideDown();

                                               }
                                               $("div.loading").hide();
                                           }

                                       );

                                   }



                               });

                               $("button#send").click(function () {
                                   $("div.loading").show();

                                   $.post($("#myForm").attr("action"),
                                       $("#myForm :input").serializeArray(),
                                       function (data) {
                                           if (data == false) {
                                               $("div#status").removeClass().addClass("green").html("Kullanıcı Başarıyla Güncellendi").slideDown();


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

                       }else{
                           echo "Böyle Bir Kullanıcı Yok";
                       }

                       }
                        elseif(@$_GET["action"]=="messages" && @$_GET["do"]==""){



                                $bul = $Class_Database->query("SELECT messages.id,yazarlar.ad as `yazar`,yazarlar.img_url,messages.title,messages.content_img,messages.content,messages.date FROM `messages` INNER JOIN `yazarlar` ON yazarlar.id = messages.yazar_id ORDER BY id DESC");
                                if (!$bul) {
                                    echo $bul->errorInfo()[2];
                                }


                            ?>

                            <div class="col-md-12 col-sm-12 col-xs-12">

                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Duyurular</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <table id="datatable-responsive"
                                               class="table table-striped table-bordered dt-responsive nowrap"
                                               cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tarih</th>
                                                <th>Yazar</th>
                                                <th>Başlık</th>
                                                <th>İçerik Resmi</th>
                                                <th>İçerik</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            while ($data = $bul->fetch(PDO::FETCH_ASSOC)) {



                                                ?>
                                                <tr>
                                                    <td><?php echo $data["id"]; ?></td>
                                                    <td><?php echo $data["date"]; ?></td>
                                                    <td><?php echo $data["yazar"]; ?></td>
                                                    <td><?php echo $data["title"]; ?></td>
                                                    <td><a href="<?php echo $data["content_img"]; ?>" target="_blank" ><?php echo $data["content_img"]; ?></a></td>
                                                    <td><?php echo $data["content"]; ?></td>
                                                    <td><a style="color:#55874d"
                                                           href="?action=messages&do=update&id=<?php echo $data["id"]; ?>">Düzenle</a>
                                                    </td>

                                                </tr>
                                                <?php
                                            }
                                            ?>


                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>


                        <?php
                        }
                        elseif($_GET["action"]=="messages" && $_GET["do"]=="update" && $_GET["id"]!==""){

                            $id= $_GET["id"];


                                $bul = $Class_Database->prepare("SELECT messages.id,yazarlar.ad as `yazar`,yazarlar.img_url,messages.title,messages.content_img,messages.content,messages.date FROM `messages` INNER JOIN `yazarlar` ON yazarlar.id = messages.yazar_id WHERE messages.id=? ");
                                if (!$bul) {

                                    echo $Class_Database->errorInfo()[2];

                                }

                        $bul->execute(array($id));


                            if($bul->rowCount()>0) {

                            $data=$bul->fetch(PDO::FETCH_ASSOC);






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

                                        <form class="form-horizontal form-label-left" id="myForm" method="POST" action="inc/messageapi.php?action=updatemessage">

                                            <span class="section">Duyuru Düzenle</span>

                                            <p>Duyuru ID : <?=$data["id"];  ?></p>
                                            <p>Yazar : <?=$data["yazar"];  ?></p>
                                            <p>Tarih :<?=$data["date"];  ?></p>




                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Başlık <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="title" class="form-control col-md-7 col-xs-12" required value="<?php echo $data["title"];  ?>" name="title" placeholder="Başlık"  type="text">
                                                </div>
                                            </div>


                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content_img">Resim URL </span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="content" class="form-control col-md-7 col-xs-12"  name="content_img" placeholder="URL" value="<?php echo $data["content_img"];  ?>"/>
                                                </div>
                                            </div>


                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">İçerik <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <textarea id="content" class="form-control col-md-7 col-xs-12"  required  name="content" style="height:150px;" placeholder="İçerik" ><?php echo $data["content"];  ?></textarea>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="<?php echo $id; ?>">


                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-3">
                                                    <button id="send" type="submit" class="btn btn-success">Submit</button>

                                                    <button id="del" class="btn btn-danger">Duyuruyu Sil</button>


                                                    <a href="javascript:history.back(-1);">Go Back</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <script>
                                $("button#del").click(function (e) {
                                    e.preventDefault();

                                    if(confirm("Bu Duyuruyu Silmek İstediğiniden Emin Misiniz?")){
                                        $.get(
                                            "inc/messageapi.php?action=delete&id=<?=$_GET["id"]?>",
                                            function (data) {
                                                if (data == false) {
                                                    alert("Duyuru Başarıyla Silindi");
                                                    window.location.replace("index.php")



                                                } else {
                                                    $("div#status").addClass("red").html(data).slideDown();

                                                }
                                                $("div.loading").hide();
                                            }

                                        );

                                    }



                                });
                                $("button#send").click(function () {
                                    $("div.loading").show();

                                    $.post($("#myForm").attr("action"),
                                        $("#myForm :input").serializeArray(),
                                        function (data) {
                                            if (data == false) {
                                                $("div#status").removeClass().addClass("green").html("Duyuru Başarıyla Güncellendi").slideDown();

                                                setTimeout(function () {
                                                    window.location.replace("?action=messages");

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

    }else{
        echo "Böyle Bir Kullanıcı Yok";
    }

                        }
                        elseif(@$_GET["action"]=="yazarlar" && @$_GET["do"]==""){



    $bul = $Class_Database->query("SELECT * FROM `yazarlar` ORDER BY id DESC");
    if (!$bul) {
        echo $bul->errorInfo()[2];
    }


    ?>

                            <div class="col-md-12 col-sm-12 col-xs-12">

                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Yazarlar</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <table id="datatable-responsive"
                                               class="table table-striped table-bordered dt-responsive nowrap"
                                               cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Ad</th>
                                                <th>Url</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            while ($data = $bul->fetch(PDO::FETCH_ASSOC)) {



                                                ?>
                                                <tr>
                                                    <td><?php echo $data["id"]; ?></td>
                                                    <td><?php echo $data["ad"]; ?></td>
                                                    <td><a href="<?php echo $data["img_url"]; ?>" ><?php echo $data["img_url"]; ?></a></td>
                                                    <td><a style="color:#55874d"
                                                           href="?action=yazarlar&do=update&id=<?php echo $data["id"]; ?>">Düzenle</a>
                                                    </td>

                                                </tr>
                                                <?php
                                            }
                                            ?>


                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>


                            <?php
                        }
                        elseif($_GET["action"]=="yazarlar" && $_GET["do"]=="update" && $_GET["id"]!==""){

                            $id= $_GET["id"];


                            $bul = $Class_Database->prepare("SELECT * FROM `yazarlar` WHERE id=? ");
                            if (!$bul) {

                                echo $Class_Database->errorInfo()[2];

                            }

                            $bul->execute(array($id));


                            if($bul->rowCount()>0) {

                            $data=$bul->fetch(PDO::FETCH_ASSOC);






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

                                        <form class="form-horizontal form-label-left" id="myForm" method="POST" action="inc/yazarapi.php?action=updateyazar">

                                            <span class="section">Yazar Düzenle</span>

                                            <p>Yazar ID : <?=$data["id"];  ?></p>




                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Ad <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="title" class="form-control col-md-7 col-xs-12" required value="<?php echo $data["ad"];  ?>" name="ad" placeholder="Ad"  type="text">
                                                </div>
                                            </div>


                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="img_url">Yazar Resmi <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="title" class="form-control col-md-7 col-xs-12" required value="<?php echo $data["img_url"];  ?>" name="img_url" placeholder="Url"  type="text">
                                                </div>
                                            </div>


                                            <input type="hidden" name="id" value="<?php echo $id; ?>">


                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-3">
                                                    <button id="send" type="submit" class="btn btn-success">Submit</button>

                                                    <button id="del" class="btn btn-danger">Duyuruyu Sil</button>


                                                    <a href="javascript:history.back(-1);">Go Back</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <script>
                                $("button#del").click(function (e) {
                                    e.preventDefault();

                                    if(confirm("Bu Yazarı Silmek İstediğiniden Emin Misiniz?")){
                                        $.get(
                                            "inc/yazarapi.php?action=delete&id=<?=$_GET["id"]?>",
                                            function (data) {
                                                if (data == false) {
                                                    alert("Yazar Başarıyla Silindi");
                                                    window.location.replace("?action=yazarlar")



                                                } else {
                                                    $("div#status").addClass("red").html(data).slideDown();

                                                }
                                                $("div.loading").hide();
                                            }

                                        );

                                    }



                                });
                                $("button#send").click(function () {
                                    $("div.loading").show();

                                    $.post($("#myForm").attr("action"),
                                        $("#myForm :input").serializeArray(),
                                        function (data) {
                                            if (data == false) {
                                                $("div#status").removeClass().addClass("green").html("Duyuru Başarıyla Güncellendi").slideDown();

                                                setTimeout(function () {
                                                    window.location.replace("?action=yazarlar");

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

                        }else{
                            echo "Böyle Bir Kullanıcı Yok";
                        }

                        }
                        elseif(@$_GET["action"]=="anket" && @$_GET["do"]==""){



                            $bul = $Class_Database->query("SELECT anket.id,anket.title,yazarlar.ad as `yazar`,anket.content,anket.date FROM `anket` INNER JOIN `yazarlar` ON anket.author_id=yazarlar.id ORDER BY id DESC");
                            if (!$bul) {
                                echo $bul->errorInfo()[2];
                            }


                            ?>

                            <div class="col-md-12 col-sm-12 col-xs-12">

                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Anketler</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <table id="datatable-responsive"
                                               class="table table-striped table-bordered dt-responsive nowrap"
                                               cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Yazar</th>
                                                <th>Title</th>
                                                <th>Önizleme</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            while ($data = $bul->fetch(PDO::FETCH_ASSOC)) {



                                                ?>
                                                <tr>
                                                    <td><?=$data["id"]; ?></td>
                                                    <td><?=$data["yazar"]; ?></td>
                                                    <td><?=$data["title"]; ?></td>
                                                    <td>
                                                        <a href="/?action=anket&do=preview&content=<?=htmlspecialchars($data["content"])?>&title=<?=htmlspecialchars($data["title"])?>&yazar=<?=htmlspecialchars($data["yazar"])?>" target="_blank">Önizleme</a ></td>

                                                    <td><button id="del" data-id="<?=$data["id"]?>" class="btn btn-danger">Anketi Sil
                                                        </button>
                                                    </td>

                                                </tr>
                                                <?php
                                            }
                                            ?>


                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>


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
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src=".vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

    <!-- Datatables -->
    <script>
        $(document).ready(function() {
            var handleDataTableButtons = function() {
                if ($("#datatable-buttons").length) {
                    $("#datatable-buttons").DataTable({
                        dom: "Bfrtip",
                        buttons: [
                            {
                                extend: "copy",
                                className: "btn-sm"
                            },
                            {
                                extend: "csv",
                                className: "btn-sm"
                            },
                            {
                                extend: "excel",
                                className: "btn-sm"
                            },
                            {
                                extend: "pdfHtml5",
                                className: "btn-sm"
                            },
                            {
                                extend: "print",
                                className: "btn-sm"
                            },
                        ],
                        responsive: true
                    });
                }
            };

            TableManageButtons = function() {
                "use strict";
                return {
                    init: function() {
                        handleDataTableButtons();
                    }
                };
            }();

            $('#datatable').dataTable();

            $('#datatable-keytable').DataTable({
                keys: true
            });

            $('#datatable-responsive').DataTable();

            $('#datatable-scroller').DataTable({
                ajax: "js/datatables/json/scroller-demo.json",
                deferRender: true,
                scrollY: 380,
                scrollCollapse: true,
                scroller: true
            });

            $('#datatable-fixed-header').DataTable({
                fixedHeader: true
            });

            var $datatable = $('#datatable-checkbox');

            $datatable.dataTable({
                'order': [[ 1, 'asc' ]],
                'columnDefs': [
                    { orderable: false, targets: [0] }
                ]
            });
            $datatable.on('draw.dt', function() {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_flat-green'
                });
            });

            TableManageButtons.init();
        });
    </script>
    <!-- /Datatables -->

    <script>
        $("button#del").click(function (e) {
            e.preventDefault();

            if(confirm("Bu Anketi Silmek İstediğiniden Emin Misiniz?")){
                $.get(
                    "inc/anketapi.php?action=delete&id="+$(this).attr("data-id"),
                    function (data) {
                        if (data == false) {
                            alert("Anket Başarıyla Silindi");
                            window.location.replace("?action=anket")



                        } else {
                            alert(data);

                        }
                    }

                );

            }



        });

    </script>
    </body>
    </html>
        <?php

?>