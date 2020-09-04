<?php
error_reporting(0);
session_start();
//生成验证码图片
header("Content-type: image/png");
$im = imagecreatetruecolor(44, 18); //创建图像，指明宽高
$back = ImageColorAllocate($im, 245, 245, 245); //为指定图像分配着色，RGB
imagefill($im, 0, 0, $back); //在image图像的坐标x ，y（图像左上角为 0, 0）处用color颜色执行区域填充（即与x, y点颜色相同且相邻的点都会被填充）。
srand((double)microtime()*1000000); //生成随机数种子
//生成4位数字
for ($i = 0; $i < 4; $i++){
    $font = ImageColorAllocate($im, rand(100, 255), rand(0, 100), rand(100, 255));
    $authnum = rand(1, 9);
    $vcodes .= $authnum;
    imagestring($im, 5, 2+$i*10, 1, $authnum, $font);
}//加入干扰象素
for ($i = 0; $i < 100; $i++)
{
    $randcolor = ImageColorallocate($im, rand(0, 255), rand(0, 255), rand(0, 255));
    imagesetpixel($im, rand()%70, rand()%30, $randcolor); //画一个单一像素，一个点
} 
ImagePNG($im);
ImageDestroy($im);
$_SESSION['VCODE'] = $vcodes;

?>