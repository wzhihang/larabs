<?php
/**
 * Created by PhpStorm.
 * User: han
 * Date: 2018/6/14
 * Time: 16:53
 */

namespace App\Handlers;



use Image;

class ImageUploadHander
{
    protected $allowed_ext = ['jpg', 'png', 'jpeg', 'gif'];

    /**
     * @param $file request file
     * @param $folder
     * @param $file_peifix
     * @return array|bool
     */
    public function save($file, $folder, $file_peifix, $max_width = false)
    {
        $folder_name = "uploads/images/$folder/" . date('Ym/d', time());

        $upload_path = public_path() . '/' . $folder_name;

        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        $filename = $file_peifix . '_' . time() . '_' . str_random() . '.' . $extension;

        if (!in_array($extension, $this->allowed_ext)) {
            return false;
        }

        $file->move($upload_path, $filename);

        //如果限制了图片宽度,就进行裁剪
        if ($max_width && $extension != 'gif') {
            $this->reduceSize($upload_path . '/' . $filename, $max_width);
        }

        return [
            'path' => config('app.url') . "/$folder_name/$filename",
        ];
    }

    public function reduceSize($file_path, $max_width)
    {
        //实例化
        $image = Image::make($file_path);

        $image->resize($max_width, null, function ($constraint) {

            // 设定宽度是 $max_width，高度等比例双方缩放
            $constraint->aspectRatio();

            // 防止裁图时图片尺寸变大
            $constraint->upsize();
        });

        $image->save();
    }

}