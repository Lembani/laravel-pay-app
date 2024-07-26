<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Lembani\MoneyUnify\MoneyUnifyClient;

class MoneyUnifyController extends Controller
{
    public function showRequestPaymentForm()
    {
        return view('request-payment');
    }

    public function handleRequestPayment(Request $request, MoneyUnifyClient $moneyUnifyClient)
    {
        $request->validate([
            'phone_number' => 'required|digits:10',
            'amount' => 'required|numeric|min:1',
        ]);

        $phoneNumber = $request->input('phone_number');
        $amount = $request->input('amount');

        try {
            $response = $moneyUnifyClient->requestPayment($phoneNumber, $amount);
            return view('request-payment', ['response' => $response]);
        } catch (\Exception $e) {
            return view('request-payment', ['error' => $e->getMessage()]);
        }
    }
}
