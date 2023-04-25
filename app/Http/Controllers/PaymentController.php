<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Http\Resources\PaymentCreditCardResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::find(1);

        if (!is_null($customer) && is_null($customer->customer_id)) {

            $phone = preg_replace( '/[^0-9]/', '', $customer->phone);

            $response = Http::withHeaders([
               'access_token' => getenv('ASAAS_API_KEY'),
                'Content-Type' => 'application/json'
            ])->post('https://sandbox.asaas.com//api/v3/customers', [
                'name' => $customer->name,
                'cpfCnpj' => $customer->cpfCnpj,
                'email' => $customer->email,
                'phone' => $phone,
                'postalCode' => $customer->postalCode,
                'addressNumber' => $customer->addressNumber,
                'externalReference' => $customer->id
            ]);

            if ($response->successful()) {
                $responseObj = $response->object();

                $customer->customer_id = $responseObj->id;
                $customer->save();
            }
        }

        $value = number_format(mt_rand(1,19999) / 10, 2, ',', '.');

        return view('home', [
            'customer' => $customer,
            'value' => $value
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        $inputs = $request->all();
        $value = str_replace('.', '', $inputs['value']);
        $value = floatval(str_replace(',', '.', $value));

        $customer = Customer::find($inputs['customer_id']);

        $url = 'https://sandbox.asaas.com/api/v3/payments';

        switch ($inputs['billingType']) {

            case 'CREDIT_CARD':
                $phone = preg_replace( '/[^0-9]/', '', $customer->phone);

                $body = [
                    'customer' => $customer->customer_id,
                    'billingType' => 'CREDIT_CARD',
                    'value' => $value,
                    'dueDate' => date('Y-m-d'),
                    'creditCard' => [
                        'holderName' => $inputs['holderName'],
                        'number' => str_replace(' ', '', trim($inputs['number'])),
                        'expiryMonth' => $inputs['expiryMonth'],
                        'expiryYear' => $inputs['expiryYear'],
                        'ccv' => $inputs['ccv']
                    ],
                    'creditCardHolderInfo' => [
                        'name' => $customer->name,
                        'email' => $customer->email,
                        'cpfCnpj' => $customer->cpfCnpj,
                        'postalCode' => $customer->postalCode,
                        'addressNumber' => $customer->addressNumber,
                        'phone' => $phone
                    ],
                    'remoteIp' => $_SERVER['REMOTE_ADDR']
                ];

                break;

            case 'BOLETO':
                $body = [
                    'customer' => $customer->customer_id,
                    'billingType' => 'BOLETO',
                    'value' => $value,
                    'dueDate' => date('Y-m-d'),
                    'fine' => [
                        'value' => 1
                    ],
                    'interest' => [
                        'value' => 2
                    ]
                ];
                break;

            case 'PIX':
                $body = [
                    'customer' => $customer->customer_id,
                    'billingType' => 'PIX',
                    'value' => $value,
                    'dueDate' => date('Y-m-d'),
                ];

                break;
        }

        $response = Http::withHeaders([
            'access_token' => getenv('ASAAS_API_KEY'),
            'Content-Type' => 'application/json'
        ])->post($url, $body);

        if ($response->successful()) {
            $responseObj = $response->object();

            $resourceResponse = (new PaymentCreditCardResource($responseObj))->response();
            $resourceResponse = json_decode($resourceResponse->getContent(), true);

            if ($inputs['billingType'] === 'PIX') {

                $id = $resourceResponse['id'];

                $responseQRCode = Http::withHeaders([
                    'access_token' => getenv('ASAAS_API_KEY'),
                    'Content-Type' => 'application/json'
                ])->get("https://sandbox.asaas.com/api/v3/payments/$id/pixQrCode");

                $responseQRCodeObj = $responseQRCode->object();
            }

            return view('/success', [
                'response' => $resourceResponse,
                'QRCode' => $responseQRCodeObj ?? null
            ]);
        } else {
            $errorsResponse = $response->object()->errors;

            foreach ($errorsResponse as $error) {
                Session::flash($error->code, $error->description);
            }

            return back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show()
    {
        return view('success');
    }


}
