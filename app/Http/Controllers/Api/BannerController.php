<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $language = $request->get('language', 'zh');
        $banners = Banner::where('language', $language)
            ->where('status', 1)
            ->orderBy('sort')
            ->get();
        foreach ($banners as &$banner) {
            $banner->image_large = $banner->image_large ? url($banner->image_large) : null;
            $banner->image_small = $banner->image_small ? url($banner->image_small) : null;
        }   

        return response()->json([
            'success' => true,
            'data' => $banners
        ]);
    }
}