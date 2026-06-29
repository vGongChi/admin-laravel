<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteConfig;
use Illuminate\Http\Request;

class SiteConfigController extends Controller
{
    public function index(Request $request)
    {
        $language = $request->get('language', 'zh');
        $configs = SiteConfig::where(function ($query) use ($language) {
            $query->where('language', $language)
                  ->orWhereNull('language');
        })->get()->keyBy('key_name');

        return response()->json([
            'success' => true,
            'data' => $configs
        ]);
    }

    public function show(Request $request, $key)
    {
        $language = $request->get('language', 'zh');
        $config = SiteConfig::where('key_name', $key)
            ->where(function ($query) use ($language) {
                $query->where('language', $language)
                      ->orWhereNull('language');
            })
            ->first();

        if (!$config) {
            return response()->json([
                'success' => false,
                'message' => 'Config not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $config
        ]);
    }
}