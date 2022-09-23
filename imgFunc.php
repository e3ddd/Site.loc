<?php

function processe($out_image, $image_name, $width, $height)
{
    $image = imagecreatefromjpeg($image_name);
    $img = imagescale($image, $width, $height);
    header("Content-type: image/jpeg");
    return imagejpeg($img,$out_image);
}
