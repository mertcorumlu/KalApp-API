<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="include/anket/css/slick.css">
    <link rel="stylesheet" href="include/anket/css/slick-theme.css">
    <link rel="stylesheet" href="include/anket/css/style.css">

    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>

</head>

<body>
<div class="login">

    <div class="anket_header">

        <div class="header">

            <div class="header_title">
                <div class="header_img">
                    <img src="<?=@$data["img_url"]?>" alt="">
                </div>
                <h1 class="anket_name"><?=@$data["title"]?></h1>
                <h2 class="anket_yazar">&nbsp;<?=@$data["yazar"]?></h2>
            </div>

        </div>

        <div class="progress" id="prog">
            <div class="value"></div>
        </div>

    </div>

    <div class="loginform">
        <div class="loading"></div>



    <form id="myForm" action="?action=anket&do=anket_kaydet&hash=<?=$hash?>&anket_id=<?=$id?>" method="POST">
        <div id="status"></div>

        <?php
         //var_dump($data);
        $index_name=0;
         foreach($data["content"] as $content){

             ?>
             <h3 class="soru_head">
                 <?=$content->soru?>
             </h3>
        <?php
             $div_type=null;
             if($content->type == "text_checkbox" || $content->type == "text_radio"){
                 $div_type="normal";
             }elseif ($content->type == "image_checkbox" || $content->type == "image_radio"){
                 $div_type="slick";
             }

             $input_type=null;
             if($content->type == "text_checkbox" || $content->type == "image_checkbox"){
                 $input_type="checkbox";
             }elseif ($content->type == "text_radio" || $content->type == "image_radio"){
                 $input_type="radio";
             }

             ?>
             <div class="<?=$div_type?>">

                 <?php
                 $index_value=0;
                 foreach ($content->options as $options){

                     ?>

                     <p>
                         <input type="<?=$input_type?>" data-index="<?=$index_name?>" name="<?=$index_name?><?php if($input_type ==("text_checkbox"||"image_checkbox")) echo "[]"; ?>" value="<?=$index_value?>" id="opt<?=$index_name?><?=$index_value?>" required>

                         <?php
                         if($content->type == "image_checkbox" || $content->type == "image_radio"){

                             $opt_content='<img src="'.$options->opt_content.'" alt="" class="radioimg">';
                             $attr=$input_type."-image";
                         }else{
                             $opt_content=$options->opt_content;
                             $attr="";
                         }
                         ?>
                         <label for="opt<?=$index_name?><?=$index_value?>" class="<?=$input_type?>Label <?=$attr?>">

                             <?=$opt_content?>
                         </label>


                     </p>


                 <?php
                     $index_value++;
                 }


                 ?>

             </div>


        <?php

            $index_name++;
         }



        ?>


        <p id="submit_button">
            <button id="submit" disabled>Gönder</button>

        </p>

    </form>


</div>
</div>



<script src="include/anket/js/slick.min.js"></script>
<script>

    $('.slick').slick({
        centerMode: true,
        centerPadding: '50px',
        slidesToShow: 1,
        arrows: true,
        infinite:false
    });

    var total= $("div.normal").length+ $("div.slick").length;
    var parts=100/total;
    var inputs=[];
    for(var i=0;i<total;i++){
        inputs[i]=0;
    }
    var count;


    $("input").on("change",function () {
       if($("input[data-index="+$(this).attr("data-index")+"]:checked").length > 0){
           inputs[$(this).attr("data-index")]=1;
       }else{
           inputs[$(this).attr("data-index")]=0;
       }
       update()
    });

    function update(){
        var count=0;
        for(var i=0;i<inputs.length;i++){
            if(inputs[i]==1)
                count++;
        }
        $(".progress .value").css({width:(count*parts) + "%"});

        if(count == total){
            $("#submit").prop( "disabled", false );
        }else{
            $("#submit").prop( "disabled", true );

        }
    }

    var elem=$("#prog");
    var offset=elem.offset().top;


    $(window).scroll(function () {

        if(window.scrollY > offset ){
           if(elem.css("position") != "fixed"){
               elem.css({position:"fixed",top:0});
               $(".header").css("margin-bottom","+12px");
           }

        }else{

            if(elem.css("position") != "relative"){
                elem.css({position:"relative",top:"0"});
                $(".header").css("margin-bottom","0");
            }
        }


    });

    $("button#submit").click(function () {
        $("div.loading").show();

            $.post($("#myForm").attr("action"),
                $("#myForm :input").serializeArray(),
                function (data) {

                    if (data == false) {
                        location.reload();

                    } else {
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        $("div#status").addClass("red").html(data).slideDown();

                    }
                    $("div.loading").hide();
                });

        $("#myForm").submit(function () {
            return false;
        });

    });


</script>

</body>
</html>