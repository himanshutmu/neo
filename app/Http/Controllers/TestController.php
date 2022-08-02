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
            return response()->json($getChartData);
        } catch (\Exception $e){
            return response()->json($e->getMessage());
        }
    }

    public function getChartData($response)
    {
        $data = json_decode($response,true);
        $labels = array_keys($data['near_earth_objects']);
        $datasets = [];
        $fastest_asteroid = $this->getFastestAstoroid($data['near_earth_objects']);
            $datasets[] = [
                'label'             => "Fastest Asteroid in km/h",
                'data'              => [35.77, 12.77, 12.33, 45, 65, 85, 25, 15],
                'backgroundColor'   => "rgba(54,73,93,.5)",
                'borderColor'       => "#36495d",
                'borderWidth'       =>  3
            ];
            $datasets[] = [
                'label'             => "Closest Asteroid",
                'data'              => [24, 14, 34, 83, 71, 29, 39, 11],
                'backgroundColor'   => "rgba(71, 183,132,.5)",
                'borderColor'       => "#47b784",
                'borderWidth'       =>  3
            ];
            $datasets[] = [
                'label'             => "Average Size of the Asteroids in kilometers",
                'data'              => [19, 29, 5, 2, 79, 82, 27, 14],
                'backgroundColor'   => "rgba(81,294,189,.5)",
                'borderColor'       => "#36495d",
                'borderWidth'       =>  3
            ];
        $planetChartData = [
            'type' => 'line',
            'data' => [
                'labels' => $labels,
                'datasets' => $datasets
            ],
            'options'   => [
                'responsive'    => true,
                'lineTension'   => 1,
                'scales'        => [
                    'yAxes'     => [
                        [
                            'ticks' => [
                                'beginAtZero'   => true,
                                'padding'       => 25
                            ]
                        ]
                    ]
                ]
            ]
        ];
        return $planetChartData;
    }

    public function getFastestAstoroid($data)
    {
        return true;
    }
}
