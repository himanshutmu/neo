<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class TestController extends Controller
{
    public function getNeoFeed(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date'      => 'required|date',
            'end_date'        => 'required|date',
            'api_key'         => 'required'
        ]);
        try{
            $url = 'https://api.nasa.gov/neo/rest/v1/feed?start_date='.$request->start_date.'&end_date='.$request->end_date.'&detailed=true&api_key='.$request->api_key;
            $response = Http::get($url);
            $getChartData = $this->getChartData($response->body());
            echo $response->body();die;
            return $response->body();
        } catch (\Exception $e){
            return response()->json($e->getMessage());
        }
    }

    public function getChartData($response)
    {
        $data = json_decode($response,true);
        $labels = array_keys($data['near_earth_objects']);
        $datasets = [];
        foreach($data['near_earth_objects'] as $key => $value){
            $datasets[] = [
                ''
            ];
        }
        $planetChartData = [
            'type' => 'line',
            'data' => [
                'labels' => $labels,
                'datasets' => [
                    
                ]
            ]
        ]
    }
}
