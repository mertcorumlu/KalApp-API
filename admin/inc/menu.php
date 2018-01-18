<?php



?>


<div class="left_col scroll-view">


    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
        <div class="profile_pic">
            <img src="images/user.png" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
            <span>Hoşgeldiniz,</span>
            <h2></h2>
        </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <h3>General</h3>
            <ul class="nav side-menu">

                <li><a onclick="javascript:void(0)" href="index.php"><i class="fa fa-home"></i> Home</a>
                </li>

                <li><a><i class="fa fa-edit"></i> Ekle <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="?page=add&action=user">Yeni Kullanıcı Ekle</a></li>
                        <li><a href="?page=add&action=message">Yeni Duyuru Ekle</a></li>
                        <li><a href="?page=add&action=yazar">Yeni Yazar Ekle</a></li>
                    </ul>
                </li>

                <li><a><i class="fa fa-table"></i> Listele <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="?action=users">Kullanıcıları Listele</a></li>
                        <li><a href="?action=messages">Duyuruları Listele</a></li>
                        <li><a href="?action=yazarlar">Yazarları Listele</a></li>
                    </ul>
                </li>



            </ul>
        </div>

    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
        <a data-toggle="tooltip" href="settings.php" data-placement="top" title="Settings">
            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Lock">
            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" href="login.php?action=logout" title="Logout" id="logout">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        </a>
    </div>
    <!-- /menu footer buttons -->
</div>


