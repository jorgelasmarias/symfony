<?php

// src/Service/FileUploader.php
namespace App\Service;


class FileUploader
{

    public function upload($file, $directory){

        $filename = md5(uniqid()).'.'.$file->guessExtension();
        $file->move($directory, $filename);

        return $filename;

    }

}