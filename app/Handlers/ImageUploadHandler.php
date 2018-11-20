<?php
namespace App\Handlers;
use Intervention\Image\Facades\Image;
class ImageUploadHandler
{

    //只允许以后后缀上传
    protected $allowed_ext = ['jpg','jpeg','png','gif'];


    public function save($file,$folder,$file_prefix,$max_width = false)
    {

        //获取图片后缀
        $extension = strtolower($file->getClientOriginalExtension()) ? : 'png';

        if(!in_array($extension,$this->allowed_ext)){
            return false;
        }

        //定义目录名,$folder为参数
        $folder_name = "uploads/images/$folder/".date('ym-d',time());

        //定义上传路径
        $upload_path = public_path().'/'.$folder_name;


        //拼接文件名
        $filename = $file_prefix. '_'.time().str_random(10).'.'.$extension;

        //将图片移动到上传目录
        $file->move($upload_path,$filename);

        //如果限制了图片宽度，裁剪
        if($max_width && $extension != 'gif'){
            //从类中封装对函数，用于剪裁图片
            $this->reduceSize($upload_path. '/' . $filename,$max_width);
        }


        //返回图片路径
        return [
          'path' => config('app.url')."/$folder_name/$filename"
        ];


    }

    //裁剪图片
    public function reduceSize($file_path,$max_width)
    {
        //实例化，传参是文件的磁盘物理文件
        $image = Image::make($file_path);

        //对文件进行大小调整
        $image->resize($max_width,null,function ($constraint) {
            //设定宽度是$max_width，高度等比例双方缩放
            $constraint->aspectRatio();

            //防止裁图时图片尺寸变大
            $constraint->upsize();
        });

        //对图片修改后进行保存
        $image->save();

    }


}