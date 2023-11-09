<?php

namespace App\Http\Controllers\storage;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{
    /**
     * File Render
     */
    public function file_render ($file_params) 
    {   
        $file_path = '';
        foreach (explode(',', $file_params) as $value) {
            $file_path .= $value . DIRECTORY_SEPARATOR;
        }
        return Storage::disk('public')->get($file_path);
    }
}
