<?php
//PHP操作图片需打开配置文件中 extension=php_gd2.dll
//==================================================生成图片
$imgname = "./test.png";
//根据给定路径图片名或 web 路径创建 png 图片模板对象，图片不存在会报错，需加 @
$im = @imagecreatefrompng($imgname);
//对应的创建jpg图片的方法为 imagecreatefromjpeg ，例
//$im = imagecreatefromjpeg("http://wx.qlogo.cn/mmopen/Q3auHgzwzM4fA6602v35iaPhicn4NerIoHhHIsM6uBFjDnbn6saxic3QJBibmibterqicNwiajic1ff8Y2sPhj1ictV0wMw/096");
if (!$im) {
  //=======================创建图片对象
  //如果指定图片不存在，则创建指定大小的空图片模板对象，宽800，高500
  $im = ImageCreate(800, 500);
  //第二种创建图片方法
  $im = ImageCreateTrueColor(800, 500);

  //=======================创建颜色对象
  //依据一个模板对象，生成颜色对象，0为red值，100为green值，30为blue值
  //ImageCreate 创建的对象在此会直接将颜色填充至模板对象中，ImageCreateTrueColor 创建的对象则只创建颜色对象，不填充
  $bgc = ImageColorAllocate($im, 0, 100, 30);
  $tc = ImageColorAllocate($im, 0, 0, 0);

  //=======================填充颜色
  //为图片对象填充矩形颜色，如果空模板对象不填充颜色则为黑色
  //100，50对应矩形填充区域左上角的横纵坐标，150，200对应矩形右下角的横纵坐标
  //这里坐标对ImageCreate模板对象不起作用，全局填充，对ImageCreateTrueColor起作用。
  ImageFilledRectangle($im, 100, 50, 150, 200, $bgc);
  //第二种填充方法200,100同样为左上角横纵坐标，但这里坐标对两种方法创建的模板对象都不起作用，完全填充
  ImageFill($im, 200, 100, $bgc);

  //=======================填充文字
  //在模板对象中添加文字两种方法
  //40字体粗度，50字体左边距距离，5字体上边距距离，$tc字体颜色，这种方式只能填充英语，填中文乱码
  ImageString($im, 40, 50, 5, "just is English code", $tc);
  //添加中文18为字体大小，0字体旋转程度，100左边距距离，200上边距距离，项目目录下要有"MSYH.TTF"这个字体文件
  imagettftext($im, 18, 0, 100, 200, $tc, "MSYH.TTF", "填充中文");
}



//==================================================合成图片
// 载入图象
$img1 = imagecreatefromjpeg("image1.jpg");
$img2 = imagecreatefromjpeg("064.jpg");

//方法一合成图象 ，将参数二合成到参数一中，500离主图片左边距,400离主图片上边距,0新合图片内右边距偏移量,10新合图片内下边距偏移量, 243合到参数一后所占位置宽，90合到参数一后所占位置高
//imagecopy($img1,$img2,500,400,0,10,243,90);
//得到原始大图片尺寸
$imgage = getimagesize("064.jpg");
$src_W = $imgage[0]; //获取原图片宽度
$src_H = $imgage[1]; //获取原图片高度
//方法二合成图象并改变大小，500,400,0,10,与imagecopy作用一致，200分别是缩小后宽，高，$src_W，$src_H原图宽，高
//imagecopyresampled($img1, $img2, 500,400,0,10, 200, 200, $src_W, $src_H);
//方法三，并且合透明图必须用此方法，别的合成方法合成后该透明的地方无法透明
//500,400,0,10, 243,90,与imagecopy作用一致，100表示参数二在参数一中透明程度，范围0~100,0完全透明，100完全不透明
imagecopymerge($img1, $img2, 500, 400, 0, 10, 243, 90, 100);



//==================================================合成圆角图片
//每次生成圆的四个角中一个角，中心透明，边角有色的图片，用于合成
function get_lt($halfWidth)
{
  //根据圆形弧度创建一个正方形的图像
  $img = imagecreatetruecolor($halfWidth, $halfWidth);
  //图像的背景
  $bgcolor = imagecolorallocate($img, 223, 0, 0);
  //填充颜色
  imagefill($img, 0, 0, $bgcolor);
  //定义圆中心颜色
  $fgcolor = imagecolorallocate($img, 0, 0, 0);
  // $halfWidth,$halfWidth：以图像的右下角开始画弧
  // $halfWidth*2, $halfWidth*2：已宽度、高度画弧
  // 180, 270：指定了角度的起始和结束点
  // fgcolor：指定画弧内的颜色
  imagefilledarc($img, $halfWidth, $halfWidth, $halfWidth * 2, $halfWidth * 2, 180, 270, $fgcolor, IMG_ARC_PIE);
  //将图片中指定色设置为透明
  imagecolortransparent($img, $fgcolor);
  //变换角度
  // $img = imagerotate($img, 90, 0);
  // $img = imagerotate($img, 180, 0);
  // $img = imagerotate($img, 270, 0);
  // header('Content-Type: image/png');
  // imagepng($img);
  return $img;
}

$img1 = imagecreatefrompng("vote_2.png");
$img2 = imagecreatefromjpeg("064.jpg");
//获取图片尺寸
$imgSize = getimagesize("064.jpg");
$image_width = $imgSize[0];
$image_height = $imgSize[1];

//圆角长度，最好是图片宽，高的一半
$halfWidth = $image_width / 2;

//获取四分之一透明圆角
$lt_img = get_lt($halfWidth);

//改造$img2 左上角圆角透明
imagecopymerge($img2, $lt_img, 0, 0, 0, 0, $halfWidth, $halfWidth, 100);
//旋转图片
$lb_corner = imagerotate($lt_img, 90, 0);
//左下角
imagecopymerge($img2, $lb_corner, 0, $image_height - $halfWidth, 0, 0, $halfWidth, $halfWidth, 100);
//旋转图片
$rb_corner = imagerotate($lt_img, 180, 0);
//右上角
imagecopymerge($img2, $rb_corner, $image_width - $halfWidth, $image_height - $halfWidth, 0, 0, $halfWidth, $halfWidth, 100);
//旋转图片
$rt_corner = imagerotate($lt_img, 270, 0);
//右下角
imagecopymerge($img2, $rt_corner, $image_width - $halfWidth, 0, 0, 0, $halfWidth, $halfWidth, 100);

//生成红色
$red = imagecolorallocate($img2, 223, 0, 0);
//去除参数二中红色设成透明
imagecolortransparent($img2, $red);

imagecopymerge($img1, $img2, 117, 37, 0, 0, 64, 64, 100);



//设定http输出格式
//header ( "Content-type: image/png" );
header("Content-type: image/jpeg");

//将二进制文件流输出到网页
//imagePng ( $im );
//如果是jpg二进制流用 imagejpeg 输出图象，并且后面加路径则直接生成保存图片，不再在页面输出
//如果已有图片则覆盖生成
//imagejpeg($img1, "new.jpg");
imagejpeg($img1);

//注销模板对象
ImageDestroy($im);
ImageDestroy($img1);
ImageDestroy($img2);