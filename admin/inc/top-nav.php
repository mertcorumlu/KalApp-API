<?php

?>

<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="images/user.png" alt=""><?php echo @$username; ?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="javascript:;"> Profile</a></li>
                        <li>
                            <a href="javascript:;">
                                <span class="badge bg-red pull-right">50%</span>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li><a href="javascript:;">Help</a></li>
                        <li><a href="login.php?action=logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    </ul>
                </li>

                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" id="messages" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-green"></span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">

                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<script>
    var deneme=6;
    $(function(){


        $.get("inc/messageapi.php?action=searchmessage&start=0&end=6",function(veri){//ajaxla mesaj php ye son id i at 5 veriyi çek


            if(veri!="yok"){//veri varsa

                $("#menu1").html(veri);//verileri mesaj_ana clasının sonuna koy


            }else{
                $("#menu1").append("Veri Bulunamadı!");
            }


            var sayi=$("#menu1 li:last-child").data("id");
            $(".badge.bg-green").html(sayi);

        });


    });
    $("#messages").click(function(){
        $(".badge.bg-green").remove();
    });
    $('#menu1').on( 'mousewheel DOMMouseScroll', function (e) {

        var e0 = e.originalEvent;
        var delta = e0.wheelDelta || -e0.detail;

        this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
        e.preventDefault();
    });

    $("#menu1").scroll(function(){

        var scroll=$(this).scrollTop();//scrolun yükseklik konumunu al

        var yukseklik=$(this).prop('scrollHeight')+2;
        var toplam=yukseklik - $(this).outerHeight();


        var id=$("#menu1 li:last-child").data(id);
        if(scroll == toplam){


            $(this).append('<li style="text-align: center;background:white;" class="loading"><img  src="images/ajax-loader.gif" alt=""></li>');

            $.get("inc/messageapi.php?action=searchmessage&start="+deneme+"&end=6",function(veri){//ajaxla mesaj php ye son id i at 5 veriyi çek
                deneme=deneme+6;
                $(".loading").remove();

                if(veri!="yok"){//veri varsa

                    $("#menu1").append(veri);//verileri mesaj_ana clasının sonuna koy


                }else{
                    $("#menu1").append('<li style="text-align: center;background:white;"><p>Başka Veri Bulunamadı!</p></li>');;
                }

            });

            

        }





    });




</script>
