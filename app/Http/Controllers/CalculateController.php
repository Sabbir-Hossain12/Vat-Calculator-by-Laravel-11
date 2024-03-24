<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculateController extends Controller
{
    public function calculate(Request $request)
    {
        $grossSum = $request->input('gross_sum');
        $operation = $request->input('operation');
        $taxPercentage = $request->input('tax_percentage');

        if ($operation == 'exclude') {
            $vatAmount = - round($grossSum / (1 + ($taxPercentage / 100))- $grossSum , 2);
            $netAmount = $grossSum - $vatAmount;
        } else {
            $vatAmount = round($grossSum * ($taxPercentage / 100), 2);
            $netAmount = $grossSum + $vatAmount;
        }

        //return view('vat_calculator', compact('grossSum', 'operation', 'taxPercentage', 'vatAmount', 'netAmount'));
        return response()->json(['vatAmount' => $vatAmount, 'netAmount' => $netAmount]);
    }
}
