<?php

namespace App\Servers;

use Carbon\Carbon;
use Dflydev\ApacheMimeTypes\PhpRepository;
use Illuminate\Support\Facades\Storage;

class UploadsServer
{
    protected $disk;
    protected $mimeDetect;

    public function __construct(PhpRepository $mimeDetect)
    {
        $this->disk = Storage::disk(config('app.uploads.storage'));
        $this->mimeDetect = $mimeDetect;
    }

    /**
     * Return files and directories within a folder
     *
     * @param string $folder
     * @return array of [
     *     'folder' => 'path to current folder',
     *     'folderName' => 'name of just current folder',
     *     'breadCrumbs' => breadcrumb array of [ $path => $foldername ]
     *     'folders' => array of [ $path => $foldername] of each subfolder
     *     'files' => array of file details on each file in folder
     * ]
     */
    public function folderInfo($folder)
    {
        $folder = $this->cleanFolder($folder);
        $breadcrumbs = $this->breadcrumbs($folder);
        $slice = array_slice($breadcrumbs, -1);
        $folderName = current($slice);
        $breadcrumbs = array_slice($breadcrumbs, 0, -1);
        $subfolders = [];
        foreach (array_unique($this->disk->directories($folder)) as $subfolder) {
            $subfolders["/$subfolder"] = basename($subfolder);
        }
        $files = [];
        foreach ($this->disk->files($folder) as $path) {
            $files[] = $this->fileDetails($path);
        }
        return compact(
            'folder',
            'folderName',
            'breadcrumbs',
            'subfolders',
            'files'
        );
    }

    /**
     * 清除文件夹名称
     */
    protected function cleanFolder($folder)
    {
        return '/' . trim(str_replace('..', '', $folder), '/');
    }

    /**
     * 返回当前目录路径
     */
    protected function breadcrumbs($folder)
    {
        $folder = trim($folder, '/');
        $crumbs = ['/' => 'root'];

        if (empty($folder)) {
            return $crumbs;
        }

        $folders = explode('/', $folder);
        $build = '';
        foreach ($folders as $folder) {
            $build .= '/'.$folder;
            $crumbs[$build] = $folder;
        }

        return $crumbs;
    }

    /**
     * 返回文件详细信息数组
     */
    protected function fileDetails($path)
    {
        $path = '/' . ltrim($path, '/');

        return [
            'name' => basename($path),
            'fullPath' => $path,
            'webPath' => $this->fileWebpath($path),
            'mimeType' => $this->fileMimeType($path),
            'size' => $this->fileSize($path),
            'modified' => $this->fileModified($path),
        ];
    }

    /**
     * 返回文件完整的web路径
     */
    public function fileWebpath($path)
    {
        $path = rtrim(config('blog.uploads.webpath'), '/') . '/' .ltrim($path, '/');
        return url($path);
    }

    /**
     * 返回文件MIME类型
     */
    public function fileMimeType($path)
    {
        return $this->mimeDetect->findType(
            pathinfo($path, PATHINFO_EXTENSION)
        );
    }

    /**
     * 返回文件大小
     */
    public function fileSize($path)
    {
        return $this->disk->size($path);
    }

    /**
     * 返回最后修改时间
     */
    public function fileModified($path)
    {
        return Carbon::createFromTimestamp(
            $this->disk->lastModified($path)
        );
    }

    /**
     * 创建新目录
     */
    public function createDirectory($folder)
    {
        $folder = $this->cleanFolder($folder);

        if ($this->disk->exists($folder)) {
            return "文件 '$folder' 已经存在";
        }

        return $this->disk->makeDirectory($folder);
    }

    /**
     * 删除目录
     */
    public function deleteDirectory($folder)
    {
        $folder = $this->cleanFolder($folder);

        $filesFolders = array_merge(
            $this->disk->directories($folder),
            $this->disk->files($folder)
        );
        if (! empty($filesFolders)) {
            return "删除的目录内有文件";
        }

        return $this->disk->deleteDirectory($folder);
    }

    /**
     * 删除文件
     */
    public function deleteFile($path)
    {
        $path = $this->cleanFolder($path);

        if (! $this->disk->exists($path)) {
            return "文件不存在";
        }

        return $this->disk->delete($path);
    }

    /**
     * 保存文件
     */
    public function saveFile($path, $content)
    {
        $path = $this->cleanFolder($path);

        if ($this->disk->exists($path)) {
            return "文件已经存在";
        }

        return $this->disk->put($path, $content);
    }
    /*
     * params :解析base64字符流
     * authors:Mr.Geng
     * addTime:2018/1/23 12:06
     */
    public function decodeBase64($base64_image){
        header('Content-type:text/html;charset=utf-8');
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image, $result)){
            return base64_decode(str_replace($result[1], '', $base64_image));
        }
        return false;
    }
    /*
     * params :获取base64文件后缀名
     * authors:Mr.Geng
     * addTime:2018/1/23 12:06
     */
    public function getBase64Suffix($base64_image){
        header('Content-type:text/html;charset=utf-8');
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image, $result)){
            return $result[2];
        }
        return false;
    }
}