<?php
/**
 * *生成缩略图
 * @param  [type] $pic_name 传过来的图片的路径
 * @param  [type] $width    按规定的宽度
 * @param  [type] $height   按规定的高度
 * @return [type]           保存的路径
 */
function pic_thumb($pic_name,$width,$height){
    $image = new \Think\Image();
    $arr=explode ('/',$pic_name);
    for($i=1;$i<4;$i++){
        $array.=$arr[$i].'/';   //获取路径名
    }
    $image->open("$pic_name");
    $url = $array.time().'_'.mt_rand().'.png';
    // 按照原图的比例生成一个最大为$width*$height的缩略图
    $image->thumb($width, $height,\Think\Image::IMAGE_THUMB_FIXED)->save($url);
    return $url;
}

