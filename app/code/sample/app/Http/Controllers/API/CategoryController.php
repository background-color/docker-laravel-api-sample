<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function all()
    {
        /*
        $id = $request->id;
        if(!$id) {
            return $this->errJson('Bad Request.', 500);
        }
        */

        try {
            $categories = Category::select('id','name')->get();
            $result = [
                'status'  => true,
                'results' => $categories
            ];
        } catch(\Exception $e){
            return $this->errJson($e->getMessage(), $e->getCode());
        }
        return $this->resConversionJson($result);
    }

    private function resConversionJson($result, $statusCode=200)
    {
        if(empty($statusCode) || $statusCode < 100 || $statusCode >= 600){
            $statusCode = 500;
        }
        return response()->json($result, $statusCode, ['Content-Type' => 'application/json'], JSON_UNESCAPED_SLASHES);
    }
    private function errJson($mes, $code)
    {
        $result = [
            'status' => false,
            'results'=> [],
            'error' => [
                'messages' => $mes
            ],
        ];
        return $this->resConversionJson($result, $code);
    }
}
