<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /*
    * Unique File Name Generator
    */
    protected function uniqueFileName($file = null){
        if($file){
            $uniqueName = md5(rand(999,99999) . '_' . time() . '_' . str_shuffle("eofiuohyidfhgjkhviu7iweriojfo")) . '.' . $file -> getClientOriginalExtension();
        }else{
            $uniqueName = md5(rand(999,99999) . '_' . time() . '_' . str_shuffle("eofiuohyidfhgjkhviu7iweriojfo"));
        }
        return $uniqueName;
    }

    /*
    * File upload
    */
    protected function fileUpload($file = null, $path = 'upload', $prefix_name = null){
        if($file){
            // Generate file name
            $fileName = $prefix_name . '_' . $this -> uniqueFileName($file);

            // Upload file to path
            $file -> move(public_path(rtrim($path, '/')), $fileName);

            // Path for store
            $filePath = rtrim($path, '/') . '/' . $fileName;
            return $filePath;
        }
    }
}
