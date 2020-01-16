<?php

namespace app\Helpers;

use Illuminate\Support\Facades\Config;
use Storage;

class FileHelper {

    public function getFileDownloadURL($fileName){
        $fileDownloadUrl = null;
        $disk = Storage::disk('s3');
        $bucket = env('S3_BUCKET');
        $command = $disk->getDriver()->getAdapter()->getClient()->getCommand('GetObject', [
            'Bucket' => Config::get('filesystems.disks.s3.bucket'),
            'Key' => $fileName,
            'ResponseContentDisposition' => 'attachment;'
        ]);
       // dd(Config::get('filesystems.disks.s3.bucket'), $command);
        $request = $disk->getDriver()->getAdapter()->getClient()->createPresignedRequest($command, '+5 minutes');
        $fileDownloadUrl = (string)$request->getUri();

        return $fileDownloadUrl;
    }

    public function fileExists($fileName){
        if(isset($fileName) && !empty($fileName)){
            $disk = Storage::disk('s3');
            return $disk->exists($fileName);
        }
        return false;
    }

    public function uploadFile($directory, $newFileName, $newFile, $oldFileName){
        $disk = Storage::disk('s3');
        if(isset($oldFileName) && !empty($oldFileName)) {
           // $oldFileUrl = $this->getFileDownloadURL($directory . "/" . $oldFileName);
            //dd($oldFileName, $oldFileUrl, );/*
            if ($disk->exists($oldFileName)) {
                $disk->delete($oldFileName);
            }
        }

        $disk->makeDirectory($directory);
        $disk->put($newFileName, $newFile);
    }

    public function copyFile($directory, $newFileName, $oldFileName){
        $disk = Storage::disk('s3');

        $oldFileAddress = "mobileupload" .$oldFileName;
        $newFileAddress = $newFileName;

        $disk->makeDirectory($directory);
        $disk->copy($oldFileAddress, $newFileAddress);
    }
}