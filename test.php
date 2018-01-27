<?php


$image=$_POST["image"];

$decoded_img=base64_decode($image);
file_put_contents("b.jpg",$decoded_img);