<?php

namespace App\Http\Controllers;

use App\Traits\ApiTrait;
use Illuminate\Support\Str;


class HomeController extends Controller
{

    use ApiTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        dd(123333555555);
        // echo '<pre>';
        // $apiKeyId = $partnerId = "940dcd7e-85bf-430a-9712-aefd2b7da4a4";
        // $apiScretKey = $xClientSecret = "f7d83962-32dd-400e-afda-39a33396aaa1";
        // $apiOAuth = $xClientKey = "87dae0ae-87f7-43f0-aa41-f2c482c89c3c";
        // $partnerServiceId = "96000";
        // $xTimeStamp = date('c');
        // $private_key = file_get_contents('/Users/heryhandoko/Downloads/alibinalikey/rsakeypair');
        // $stringToSign = $xClientKey . '|' . $xTimeStamp;
        // /** generate token */
        // $algo = OPENSSL_ALGO_SHA256;
        // openssl_sign($stringToSign, $signature, $private_key, $algo);
        // $signature = base64_encode($signature);
        // $bodyRequest = [
        //     'grantType' => "client_credentials",
        //     'additionalInfo' => []
        // ];
        // $response = $this->aksesToken([
        //     'client_key' => $xClientKey,
        //     'timestamp' => $xTimeStamp,
        //     'signature' => $signature,
        //     'body_request' => $bodyRequest
        // ]);
        // $response = $response->object();
        // $accessToken = $response->accessToken;
        // /** create virtual account */
        // $bodyRequest  = [
        //     "partnerServiceId" => $partnerServiceId,
        //     "customerNo" => "6281380001904",
        //     // "partnerReferenceNo" => "",
        //     "virtualAccountNo" => $partnerServiceId . "6281380001904",
        //     "virtualAccountName" => "payumroh",
        //     "trxId" => "2023103200100000045",
        //     "totalAmount" => ["value" => "0.00", "currency" => "IDR"],
        //     // "amount" => ["value" => "10000.00", "currency" => "IDR"],
        //     "virtualAccountTrxType" => "P",
        //     "expiredDate" => "",
        //     "additionalInfo" => [
        //         "description" => "12345679237",
        //         "payment" => "PEMBAYARAN COBA",
        //         "paymentCode" => "330089",
        //         "currentAccountNo" => ""
        //     ],
        // ];

        // // $bodyRequest = [
        // //     "partnerServiceId" => $partnerServiceId,
        // //     "customerNo" => "62813800019031",
        // //     "virtualAccountNo" => $partnerServiceId . "62813800019031",
        // //     "trxId" => "BTN0000000004",
        // // ];

        // $minifyBody = json_encode($bodyRequest);
        // $shaBody = hash('sha256', $minifyBody);
        // $stringToSign = 'POST' . ":" . "/snap/v1/transfer-va/create-va" . ":" . $accessToken . ":" . $shaBody . ":" . $xTimeStamp;
        // // $stringToSign = 'POST' . ":" . "/snap/v1/transfer-va/inquiry-va" . ":" . $accessToken . ":" . $shaBody . ":" . $xTimeStamp;
        // $signatureVa = hash_hmac(
        //     'sha512',
        //     $stringToSign,
        //     $xClientSecret,
        //     true
        // );

        // /** without token */
        // $va['token'] = $accessToken;
        // $va['timestamp'] = $xTimeStamp;
        // $va['signature'] = base64_encode($signatureVa);
        // $va['partner_id'] = $apiKeyId;
        // $va['external_id'] = strtoupper(Str::random(16));
        // $va['channel_id'] = '10023';
        // $va['body_request'] = $bodyRequest;
        // $response = $this->createVA($va);
        // echo 'BODY : <textarea style="width: 700px; height: 50px;">' . $minifyBody . '</textarea>';
        // echo '<br>';
        // print_r($bodyRequest);
        // echo '<br>';
        // echo 'BEARER-TOKEN :  <textarea style="width: 700px; height: 50px;">' . $accessToken . '</textarea>';
        // echo '<br>';
        // echo 'X-CLIENT-KEY :  <textarea style="width: 700px; height: 50px;">' . $xClientKey . '</textarea>';
        // echo '<br>';
        // echo 'X-TIMESTAMP :  <textarea style="width: 700px; height: 50px;">' . $xTimeStamp . '</textarea>';
        // echo '<br>';
        // echo 'X-SIGNATURE :  <textarea style="width: 700px; height: 50px;">' . base64_encode($signatureVa) . '</textarea>';
        // echo '<br>';
        // echo 'X-PARTNER-ID :  <textarea style="width: 700px; height: 50px;">' . $apiKeyId . '</textarea>';
        // echo '<br>';
        // echo 'X-EXTERNAL-ID :  <textarea style="width: 700px; height: 50px;">' . $va['external_id'] . '</textarea>';
        // echo '<br>';
        // echo 'CHANNEL-ID :  <textarea style="width: 700px; height: 50px;">' . $va['channel_id'] . '</textarea>';
        // echo '<br> RESPONSE <br>';
        // // $response = $response->getBody()->getContents();
        // // $response = json_decode($response);
        // print_r($response);
        // echo '<br>';
        // die();
        return view('home');
    }
}
