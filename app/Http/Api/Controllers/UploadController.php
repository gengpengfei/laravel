<?php

namespace App\Http\Api\Controllers;

use App\Servers\ImageServer;
use App\Servers\QrCodeServer;
use App\Servers\UploadsServer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    protected $manager;
    protected $imgage;
    public function __construct(UploadsServer $manager,ImageServer $image)
    {
        $this->manager = $manager;
        $this->image = $image;
    }

    /*
     * params :获取文件夹或文件列表
     * explain:folder为最底层文件夹时返回文件列表
     * authors:Mr.Geng
     * addTime:2018/1/23 11:14
     */
    public function fileList(Request $request)
    {
        $folder = $request->get('folder');
        $data = $this->manager->folderInfo($folder);
        return $this->returnJson($data,'文件列表','1');
    }
    /*
     * params : 创建目录
     * explain: folder 和 new_folder可以单独和联合使用
     * author : Mr.Geng
     * addTime: 2018/1/23 10:49
     */
    public function createFolder(Request $request)
    {
        $new_folder = $request->get('new_folder');
        $folder = $request->get('folder').'/'.$new_folder;
        $result = $this->manager->createDirectory($folder);
        if ($result === true) {
            return $this->returnJson($folder,'创建文件成功','1');
        }
        return $this->returnJson($result,'创建文件失败','-1');
    }
    /*
     * params :删除目录
     * explain:folder 可单独使用 del_folder 必须加上folder路径
     * authors:Mr.Geng
     * addTime:2018/1/23 11:07
     */
    public function deleteFolder(Request $request)
    {
        $del_folder = $request->get('del_folder');
        $folder = $request->get('folder').'/'.$del_folder;
        $result = $this->manager->deleteDirectory($folder);
        if ($result === true) {
            return $this->returnJson($folder,"目录".$del_folder."删除成功",'1');
        }
        return $this->returnJson($result,"目录".$del_folder."删除失败",'-1');
    }
    /*
     * params :删除文件
     * explain:folder 可单独使用直接指向文件
     * authors:Mr.Geng
     * addTime:2018/1/23 11:18
     */
    public function deleteFile(Request $request)
    {
        $del_file = $request->get('del_file');
        $path = $request->get('folder').'/'.$del_file;
        $result = $this->manager->deleteFile($path);
        if ($result === true) {
            return $this->returnJson($path,"文件".$del_file."删除成功",'1');
        }
        return $this->returnJson($result,"文件".$del_file."删除失败",'-1');
    }
    /*
     * params :input文件上传
     * explain: file from表单 file_name 重命名 folder 目录
     * authors:Mr.Geng
     * addTime:2018/1/23 11:28
     */
    public function uploadFile(Request $request)
    {
        $file = $_FILES['file'];
        $fileName = $request->get('file_name');
        $fileName = $fileName ?: $file['name'];
        $path = str_finish($request->get('folder'), '/') . $fileName;
        $content = File::get($file['tmp_name']);
        $result = $this->manager->saveFile($path, $content);
        if ($result === true) {
            return $this->returnJson($path,"文件".$fileName."上传成功",'1');
        }
        return $this->returnJson($result,"文件".$fileName."上传失败",'-1');
    }
    /*
     * params :base64文件上传
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/23 12:52
     */
    public function uploadBase64(Request $request)
    {
        $base64File = $request->get("file");
        $fileName = $request->get('file_name');
        $fileName = $fileName ?: uniqid().".".$this->manager->getBase64Suffix($base64File);
        $path = str_finish($request->get('folder'), '/') .dateFile()."/" .$fileName;
        $result = $this->manager->saveFile($path,$this->manager->decodeBase64($base64File));
        if ($result === true) {
            return $this->returnJson($path,"文件".$fileName."上传成功",'1');
        }
        return $this->returnJson($result,"文件".$fileName."上传失败",'-1');
    }
    /*
     * params : 图像处理
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/24 11:44
     */
    public function uploadImg(Request $request)
    {
        $path = "./uploads/2018/5a66ca41174ed.jpeg";
        $this->image->setImg($path);
        return $this->image->setLine(20,10,20,200)->setText("哈哈hahahahaha",50,50)->setMark("./uploads/2018/5a66ca41174ed.jpeg",200,200)->responseImg();
    }

    /*
     * params :创建二维码
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/25 18:12
     */
    public function getCode(Request $request ,QrCodeServer $qrCodeServer)
    {
        return $qrCodeServer->setFormat()->setEncoding()->setSize()->getCode("哈哈");
    }
}