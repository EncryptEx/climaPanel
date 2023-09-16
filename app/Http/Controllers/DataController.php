<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Data;

class DataController extends Controller
{
    public function store(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'type' => 'required|max:255',
            'value' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=>false, 'message'=>$validator->errors(), 'timestamp'=> time()], 400);
        }

        $data = new Data;

        $data->type = $request->type;
        $data->ownerId = $request->user()->id;
        $data->value = $request->value;

        $data->save();

        return response()->json(['success'=>true, 'message'=>'Data saved successfully', 'timestamp'=> time()], 200);

    }
}
