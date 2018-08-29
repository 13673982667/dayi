<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/24
 * Time: 10:05
 */


/**
图片压缩操作类
v1.0
 */
   class Image{

       private $src;
       private $imageinfo;
       private $image;
       public  $percent = 0.1;
//       public  $path = './MyFiles/';
       public function __construct($src){

           $this->src = $src;

       }
       /**
       打开图片
        */
       public function openImage(){
            //list  把数组中的值依次赋值给变量
           list($width, $height, $type, $attr) = getimagesize($this->src);
           $this->imageinfo = array(

               'width'=>$width,
               'height'=>$height,
               'type'=>image_type_to_extension($type,false),  // image_type_to_extension  返回图片名称的后缀（获取图片类型）
               'attr'=>$attr
           );
           $fun = "imagecreatefrom".$this->imageinfo['type'];            // imagecreatform  创建一块画布并载入一副图片
           $this->image = $fun($this->src);
       }
       /**
       操作图片
        */
       public function thumpImage(){

           $new_width = $this->imageinfo['width'] * $this->percent;
           $new_height = $this->imageinfo['height'] * $this->percent;
           $image_thump = imagecreatetruecolor($new_width,$new_height);
           //将原图复制带图片载体上面，并且按照一定比例压缩,极大的保持了清晰度
           imagecopyresampled($image_thump,$this->image,0,0,0,0,$new_width,$new_height,$this->imageinfo['width'],$this->imageinfo['height']);
           imagedestroy($this->image);
           $this->image =   $image_thump;
       }
       /**
       输出图片
        */
//       public function showImage(){
//
////           header('Content-Type: image/'.$this->imageinfo['type']);
//           $funcs = "image".$this->imageinfo['type'];
//           $funcs($this->image);
//
//       }
       /**
       保存图片到硬盘
        */
       public function saveImage($name){

           $funcs = "image".$this->imageinfo['type'];
           $funcs($this->image,'./MyFiles/'.$name.'.'.$this->imageinfo['type']);

       }
       /**
       销毁图片
        */
//       public function __destruct(){
//
//           imagedestroy($this->image);
//       }

   }


?>