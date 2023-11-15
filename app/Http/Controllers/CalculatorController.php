<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function add(Request $request)
    {
        return [
            'result' => $request->input('x') + $request->input('y')
        ];
    }

    public function multiply(Request $request)
    {
        return [
            'result' => $request->input('x') * $request->input('y')
        ];
    }

    public function divide(Request $request)
    {
        return [
            'result' => $request->input('x') / $request->input('y')
        ];
    }
}
