<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BusinessScope;
use Illuminate\Http\Request;

class BusinessScopeController extends Controller
{
    public function index(Request $request)
    {
        $language = $request->get('language', 'zh');
        $scopes = BusinessScope::where('language', $language)
            ->where('status', 1)
            ->orderBy('sort')
            ->get();

        foreach ($scopes as $scope) {
            $scope->image = $scope->image ? env('APP_URL').'/storage/admin/'.$scope->image : null;
        }

        return response()->json([
            'success' => true,
            'data' => $scopes
        ]);
    }
}