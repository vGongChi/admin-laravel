<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    //
    public function upload(Request $request)
    {
        $urls = [];
        foreach ($request->file() as $file) {
            $urls[] = Storage::url($file->store('public/images'));
        }

        return [
            "errno" => 0,
            "data"  => $urls,
        ];
    }
}
