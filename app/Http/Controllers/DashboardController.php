<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DataController;

use App\Charts\HistoricalTemperature;

class DashboardController extends Controller
{
    // https://charts.erik.cat/create_charts.html#initiate-a-chart
    public function get(Request $request)
    {
        $chart = new HistoricalTemperature();

        $allTempByDevice = (new DataController())->getValueByUser($request->user()->id, 'temp');

        $chart->labels($allTempByDevice['labels']);
        foreach ($allTempByDevice['data'] as $deviceDatasetName => $data) {
            $chart->dataset($deviceDatasetName, 'line', $data)->options(['color' => '#fff', 'backgroundColor' => '#399cd6']);

        }

        return view('dashboard', ['chart' => $chart, 'scripts' => "<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js' charset='utf-8'></script>"]);

    }

}
