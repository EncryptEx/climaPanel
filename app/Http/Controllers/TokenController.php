<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class TokenController extends Controller
{
    public function create(Request $request) {
        $validated = $request->validate([
            'token_name' => 'required|max:255',
        ]);
        $tokens=auth()->user()->tokens;
        $nwtkn = auth()->user()->createToken($validated['token_name']);
        $newTokenName = $validated['token_name'];
        $newTokenCode = $nwtkn->plainTextToken;
        return view('token', ['tokens'=>$tokens, 'newTokenName'=>$newTokenName, 'newTokenCode'=>$newTokenCode]);  
    }

    public function deleteAll(Request $request) {
        
            auth()->user()->tokens()->delete();
            return redirect('tokens');
    }

    public function deleteOne(int $id) {
        auth()->user()->tokens()->where('id', $id)->delete();
        return redirect('tokens');
    }

    public function get() {
        return view('token', ['tokens'=>auth()->user()->tokens]);
    }
}
