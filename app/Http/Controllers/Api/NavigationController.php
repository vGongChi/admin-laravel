<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Navigation;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function index(Request $request)
    {
        $language = $request->get('language', 'zh');
        $tree = $request->boolean('tree');

        $navigations = Navigation::where('language', $language)
            ->where('status', 1)
            ->orderBy('sort')
            ->get()
            ->makeHidden(['content']);

        $data = $tree ? $this->buildTree($navigations->toArray()) : $navigations;

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * 栏目详情 如果有子栏目则返回子栏目列表 
     */
    public function show(Request $request, $id)
    {
        $language = $request->get('language', 'zh');

        $navigation = Navigation::where('id', $id)
            ->where('language', $language)
            ->where('status', 1)
            ->first();

        if (!$navigation) {
            return response()->json([
                'success' => false,
                'message' => 'Navigation item not found'
            ], 404);
        }

        $parent = null;
        $siblings = Navigation::select(['id', 'name'])->where('language', $language)
            ->where('status', 1)
            ->where('parent_id', $navigation->parent_id)
            ->orderBy('sort')
            ->get();

        if ($navigation->parent_id) {
            $parent = Navigation::select(['id', 'name'])->where('id', $navigation->parent_id)
                ->where('language', $language)
                ->where('status', 1)
                ->first();
        }
        $navigation->image = $navigation->image ? env('APP_URL').'/storage/admin/'.$navigation->image : null;

        // 如果有子栏目则返回子栏目列表
        $children = Navigation::select(['id', 'name'])->where('language', $language)
            ->where('status', 1)
            ->where('parent_id', $navigation->id)
            ->orderBy('sort')
            ->get();

        foreach ($children as $child) {
            $child->image = $child->image ? env('APP_URL').'/storage/admin/'.$child->image : null;
        }

        return response()->json([
            'success' => true,
            'data' => [
                'navigation' => $navigation,
                'parent' => $parent,
                'siblings' => $siblings,
                'children' => $children
            ]
        ]);
    }

    protected function buildTree(array $items, $parentId = 0)
    {
        $tree = [];

        foreach ($items as $item) {
            if ((int) $item['parent_id'] === (int) $parentId) {
                $children = $this->buildTree($items, $item['id']);
                if ($children) {
                    $item['children'] = $children;
                }
                $tree[] = $item;
            }
        }

        return $tree;
    }
}
