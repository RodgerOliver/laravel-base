<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class MiscController extends Controller
{

    /**
     * Checks if user has access to the file and returns it or not.
     *
     * @param  String $filename
     */
    public function licenseFileShow($filename)
    {
        /* Check if the file has extension */
        if (strpos($filename, '.') !== false) {
            if (Auth::user()->profile_picture == $filename) {
                return $this->returnFile($filename);
            } else {
                abort(403, 'Access denied');
            }
        }
        abort(404);
    }

    /**
     * Look for file and get it from the drive.
     *
     * @param  String $filename
     */
    public function returnFile($filename)
    {
        $path = storage_path('app/uploads/profile_pictures/' . $filename);
        try {
            $file = File::get($path);
            $type = File::mimeType($path);
            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        } catch (FileNotFoundException $exception) {
            abort(404);
        }
    }
}
