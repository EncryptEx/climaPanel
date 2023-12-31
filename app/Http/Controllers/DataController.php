<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Data;

class DataController extends Controller
{
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'type' => 'required|max:255',
            'deviceName' => 'required',
            'value' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors(), 'timestamp' => time()], 400);
        }

        $data = new Data();

        $data->type = $request->type;
        $data->ownerId = $request->user()->id;
        $data->deviceName = $request->deviceName;
        $data->value = $request->value;

        $data->save();

        return response()->json(['success' => true, 'message' => 'Data saved successfully', 'timestamp' => time()], 200);

    }

    public function getValueByUser(int $userId, string $dataType)
    {
        $data = Data::where('ownerId', $userId)
               ->orderBy('created_at', 'asc')
               ->get();
        $final = [];
        $labels = [];
        foreach ($data as $element) {
            $val = isset($final[$element->deviceName]) ? $final[$element->deviceName] : [];

            // show necessary data
            // $label = $element['type'];
            $newElement = (int)($element['value']);

            array_push($labels, $element['created_at']);
            array_push($val, $newElement);


            $final[$element['deviceName']] = $val;
        }
        return ['data' => $final, 'labels' => $labels];
    }
}
