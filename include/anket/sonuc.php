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
    <link rel="stylesheet" href="include/anket/css/style_sonuc.css">

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
            <div class="value" style="width:100%"></div>
        </div>

    </div>



        <div class="sonuclar">



            <?php
            $index_name=0;
            foreach($data["content"] as $content){


                ?>
            <div class="outer">
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

                    //print_r($sayac[$index_name]);

                    $index_value=0;
                    foreach ($sayac[$index_name] as $key=>$val){
                        $options=$content->options[$key];


                        ?>

                        <p>
                            <input type="<?=$input_type?>" data-index="<?=$index_name?>" name="<?=$index_name?><?php if($input_type ==("text_checkbox"||"image_checkbox")) echo "[]"; ?>" value="<?=$index_value?>" id="opt<?=$index_name.$index_value?>" disabled
                                <?php
                                if($input_type=="checkbox"){
                                    if($index_value=="0" || $index_value=="1" || $index_value=="2"){
                                        echo "checked";
                                    }
                                }elseif($input_type=="radio"){
                                    if($index_value=="0"){
                                        echo "checked";
                                    }
                                }
                                ?>
                            >

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

                        <span style="margin-top:5px;margin-bottom:2px;text-align: right;display: block;margin-right: 10px;font-size:12px;">(<?=$val?>/<?=$toplam?>) &nbsp;&nbsp; <?php echo round((($val/$toplam)*100),2) ?>%</span>
                        <span class="progress" id="sonuc">
                            <span class="value" style="width:<?php echo round((($val/$toplam)*100),2) ?>%"></span>
                        </span>
                            </label>





                        <?php

                        $index_value++;
                    }


                    ?>

                </div>
            </div>


                <?php

                $index_name++;
            }



            ?>





        </div>

</div>



<script src="include/anket/js/slick.min.js"></script>
<script>
$(document).ready(function () {
    $("html, body").animate({ scrollTop: 0 }, "slow");
    $('div.slick').slick({
        centerMode: true,
        centerPadding: '50px',
        slidesToShow: 1,
        arrows: false,
        infinite:false
    });
});


</script>

</body>
</html>