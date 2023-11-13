<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{
    private $userFilesDisk;

    public function __construct()
    {
        $this->userFilesDisk = Storage::disk('user_files');
    }

    public function getUserFile($path)
    {
        // Check if the file exists in the storage
        if (!$this->userFilesDisk->exists($path)) {
            abort(404); // Return a 404 response if the file doesn't exist
        }

        // Get the file contents and mime type from the storage
        $file = $this->userFilesDisk->get($path);
        $type = $this->userFilesDisk->mimeType($path);

        // Create a response with the file contents and appropriate headers
        $response = Response::make($file, 200);
        $response->header('Content-Type', $type);

        return $response;
    }
}
