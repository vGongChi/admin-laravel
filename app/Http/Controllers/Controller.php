<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\PointsLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(Request $request)
    {
        // Log the incoming request parameters and URL to a separate log file
        Log::channel('custom')->info('Request URL: ' . $request->fullUrl());
        Log::channel('custom')->info('Request parameters', $request->all());
    }

    public static function successResponse($data = null, $message = '操作成功', $code = 0)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ], 200); // HTTP 200 OK
    }


    public static function errorResponse($message = '操作失败', $code = 1, $data = null)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ], 400); // HTTP 400 Bad Request 或者根据需要选择其他合适的错误状态码
    }
    
    /**
     * 生成订单号
     * 这里可以根据需要自定义订单号生成规则
     *
     * @return string
     */
    public function generateOrderNo($type=0)
    {
        $orderTitle = $type ? 'M' : 'R';
        
        // 使用当前时间的微秒部分和一个随机数生成短的唯一订单号
        $uniqueId = substr(md5(uniqid(mt_rand(), true)), 0, 8);
        
        return $orderTitle .date('ymd'). $uniqueId;
    }

}
