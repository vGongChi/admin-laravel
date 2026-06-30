<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    public function index(Request $request)
    {
        $language = $request->get('language', 'zh');
        $profiles = CompanyProfile::where('language', $language)->get();

        foreach ($profiles as $profile) {
            $profile->image = $profile->image ? env('APP_URL').'/storage/admin/'.$profile->image : null;
        }

        return response()->json([
            'success' => true,
            'data' => $profiles
        ]);
    }
}