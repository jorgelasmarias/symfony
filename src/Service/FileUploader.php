<?php

// src/Service/FileUploader.php
namespace App\Service;

use App\Entity\Incidencia;


class FileUploader
{

    public function upload($file){


        $filename = md5(uniqid()).'.'.$file->guessExtension();
        $file->move('uploads/documents', $filename);

        return $filename;

    } 

}