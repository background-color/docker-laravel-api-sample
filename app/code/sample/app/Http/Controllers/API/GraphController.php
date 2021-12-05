<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Graph;

class GraphController extends Controller
{
    public function all($category_id)
    {
        if(!$category_id) {
            return $this->errJson('Bad Request.', 500);
        }

        try {
            $gratphs = Graph::select('date', 'val')->where('category_id', $category_id)->orderBy('date')->get();
            $gratph_dates  = $gratphs->pluck('date');
            $gratph_values = $gratphs->pluck('val');
            $result = [
                'status'  => true,
                'results' => ['dates' => $gratph_dates, 'values' => $gratph_values]
            ];
        } catch(\Exception $e){
            return $this->errJson($e->getMessage(), $e->getCode());
        }
        return $this->resConversionJson($result);
    }
    public function update(Request $request)
    {
        if( !$request->category_id
            || !$request->date
            || !$request->val)
            {
                return $this->errJson('Bad Request.', 500);
            }
        try
        {
            Graph::updateOrCreate(
                [
                    'category_id' => $request->category_id,
                    'date' => $request->date,
                ],
                [
                    'val' => $request->val
                ]
            );
        } catch(\Exception $e){
            return $this->errJson($e->getMessage(), $e->getCode());
        }
        return $this->resConversionJson([
            'status'  => true,
            'results' => []
        ]);
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
